<?php

namespace App\Actions\Users;

use App\Models\User;
use App\Traits\UploadsImages;
use Illuminate\Http\UploadedFile;

class UpdateUser
{
    use UploadsImages; // <--- Trait must be used here

    public function __invoke(
        User $user,
        string $name,
        string $username,
        string $email,
        ?string $phone,
        ?UploadedFile $avatar = null // <--- Type hint must allow UploadedFile or null
    ): void {

        $data = [
            'name'     => $name,
            'email'    => $email,
            'username' => $username,
            'phone'    => $phone,
        ];

        // DEBUG CHECK:
        // if ($avatar) { \Log::info('Avatar received: ' . $avatar->getClientOriginalName()); }

        if ($avatar) {
            // CALL THE TRAIT
            $data['avatar'] = $this->uploadImage(
                file: $avatar,
                oldPath: $user->avatar,
                folder: 'avatars'
            );
        }

        $user->fill($data);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        $user->save();
    }
}
