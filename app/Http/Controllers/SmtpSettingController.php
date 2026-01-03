<?php
namespace App\Http\Controllers;

use App\Models\SmtpSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
class SmtpSettingController extends Controller
{
   public function store(Request $request)
    {
        $validated = $request->validate([
            'host' => 'required',
            'port' => 'required',
            'username' => 'required',
            'password' => 'required',
            'encryption' => 'nullable',
            'from_address' => 'required|email',
            'from_name' => 'required',
        ]);

        // Manually encrypt the password before saving
        $validated['password'] = Crypt::encryptString($request->password);

        SmtpSetting::updateOrCreate(
            ['id' => 1],
            $validated
        );

        // Clear cache to be safe
        Artisan::call('config:clear');

        return response()->json(['message' => 'SMTP settings updated successfully']);
    }

    public function index()
    {
        $settings = SmtpSetting::find(1);
        if ($settings) {
            // We don't want to send the encrypted password back to frontend
            return response()->json($settings->makeHidden(['password']));
        }
        return response()->json(null);
    }
    public function testEmail(Request $request) {
        $request->validate(['email' => 'required|email']);

        try {
            Mail::raw('This is a test email from your new SMTP settings!', function ($msg) use ($request) {
                $msg->to($request->email)->subject('SMTP Test');
            });
            return response()->json(['message' => 'Test email sent successfully!, please check your inbox or junk folder.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
