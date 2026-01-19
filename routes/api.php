<?php

use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\SmtpSettingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ConsultancyInfoController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\FundApplicationController;
use App\Http\Controllers\FoundationSettingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BiographyController;
use App\Http\Controllers\PhilosophySettingController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\AcademicAchievementController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ResearchProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\CvSettingController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImpactStatController;
use App\Http\Controllers\HighlightController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\FoundationDonationController;
use App\Http\Controllers\WebsiteSettingController;
use App\Http\Controllers\CareerJourneyController;
require __DIR__.'/auth.php';

Route::middleware('auth:api')->group(function () {
    Route::get('/user-profile', [UserController::class, 'show'])
        ->name('user.show');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/user-update', [UserController::class, 'update'])
        ->name('user.update');

    Route::patch('/user/change-password', [UserController::class, 'changePassword'])
        ->name('user.change-password');

});

    Route::get('/dashboard-stats', [DashboardController::class, 'index']);
    Route::get('/impact-stats', [ImpactStatController::class, 'index']);
    Route::get('/highlights', [HighlightController::class, 'index']);

// public routes
    Route::get('/personal-info', [PersonalInfoController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
    Route::get('/donations', [DonationController::class, 'index']);
    Route::get('/donations/total', [DonationController::class, 'total']);
    Route::get('/donations/{donation}', [DonationController::class, 'show']);
    // Category Routes
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{category}', [CategoryController::class, 'show']);

    // Photo Routes
    Route::get('/photos', [PhotoController::class, 'index']);
    Route::get('/photos/{id}', [PhotoController::class, 'show']);

    // Video Routes
    Route::get('/videos', [VideoController::class, 'index']);
    Route::get('/videos/{id}', [VideoController::class, 'show']);
    // Blog Routes
    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/blogs/{blog}', [BlogController::class, 'show']);

    // News Routes
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{news}', [NewsController::class, 'show']);

    // Consultancy Info Routes
    Route::get('/consultancy-info', [ConsultancyInfoController::class, 'index']);
    Route::get('/consultancy-info/{consultancyInfo}', [ConsultancyInfoController::class, 'show']);

    Route::post('/consultations', [ConsultationController::class, 'store']);

    Route::post('/fund-applications', [FundApplicationController::class, 'store']);
    Route::get('/funded-individuals', [FundApplicationController::class, 'funded']);
    Route::get('/foundation-settings', [FoundationSettingController::class, 'index']);

    Route::get('/books', [BookController::class, 'index']); // ?type=Historic
    Route::get('/books/{book}', [BookController::class, 'show']); // Reads book info
    Route::get('/books/{book}/download', [BookController::class, 'download'])->name('books.download'); // Downloads PDF
    Route::get('/books/{book}/preview', [BookController::class, 'preview'])->name('books.preview'); // preview PDF
    Route::get('/biography', [BiographyController::class, 'index']);

    Route::get('/philosophy', [PhilosophySettingController::class, 'index']);
    Route::get('/education', [EducationController::class, 'index']);
    Route::get('/achievements', [AcademicAchievementController::class, 'index']);

    Route::get('/experiences', [ExperienceController::class, 'index']);
    Route::get('/experiences/{experience}', [ExperienceController::class, 'show']);

    Route::get('/research-projects', [ResearchProjectController::class, 'index']);
    Route::get('/research-projects/{researchProject}', [ResearchProjectController::class, 'show']);
    Route::get('/skills', [SkillController::class, 'index']);
    Route::get('/cv-settings', [CvSettingController::class, 'index']);
    Route::get('/download-cv', [CvSettingController::class, 'download']);
    Route::get('/publications', [PublicationController::class, 'index']);
    Route::get('/awards', [AwardController::class, 'index']);
    Route::get('/hobbies', [HobbyController::class, 'index']);
    Route::get('/social-links', [SocialLinkController::class, 'index']);
    Route::get('/partners', [PartnerController::class, 'index']);
    Route::get('/testimonials', [TestimonialController::class, 'index']);
    Route::get('/expertises', [ExpertiseController::class, 'index']);
    Route::get('/foundation-donation/page', [FoundationDonationController::class, 'publicPage']);
    Route::get('/settings', [WebsiteSettingController::class, 'index']);
    Route::get('/career-journeys', [CareerJourneyController::class, 'index']);









    //--------------------------- protected routes-----------------------------//

Route::middleware(['auth:api'])->group(function () {

    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index']);
    Route::put('/user/password', UpdatePasswordController::class);

    // SMTP Settings Routes
    Route::get('/smtp-settings', [SmtpSettingController::class, 'index']);
    Route::post('/smtp-settings', [SmtpSettingController::class, 'store']);
    Route::post('/test-email', [SmtpSettingController::class, 'testEmail']);

    //    Personal Info Routes
    Route::post('/personal-info', [PersonalInfoController::class, 'store']);
    Route::post('/personal-info/update', [PersonalInfoController::class, 'update']); // Use POST for update
    Route::delete('/personal-info', [PersonalInfoController::class, 'destroy']);
    // --- Donations (Admin Write) ---
    Route::post('/donations', [DonationController::class, 'store']);
    Route::put('/donations/{donation}', [DonationController::class, 'update']);
    Route::delete('/donations/{donation}', [DonationController::class, 'destroy']);
    Route::apiResource('foundation-donations', FoundationDonationController::class);

    // --- Messages (Admin Read Inbox & Reply) ---
    Route::get('/messages', [MessageController::class, 'index']);       // View Inbox
    Route::get('/messages/{message}', [MessageController::class, 'show']); // View Single
    Route::put('/messages/{message}', [MessageController::class, 'update']); // Mark Read
    Route::delete('/messages/{message}', [MessageController::class, 'destroy']); // Delete
    Route::post('/messages/{message}/reply', [MessageController::class, 'reply']); // Send Reply

    // Category Management Routes
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);

    // Photo Management Routes
    Route::post('/photos', [PhotoController::class, 'store']);
    Route::post('/photos/{id}', [PhotoController::class, 'update']); // Note: Using POST for update
    Route::delete('/photos/{id}', [PhotoController::class, 'destroy']);

    // Video Management Routes
    Route::post('/videos', [VideoController::class, 'store']);
    Route::post('/videos/{id}', [VideoController::class, 'update']); // Update via POST
    Route::delete('/videos/{id}', [VideoController::class, 'destroy']);

    // Blog Management Routes
    Route::post('/blogs', [BlogController::class, 'store']);
    Route::post('/blogs/{blog}', [BlogController::class, 'update']);
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy']);
    Route::patch('/blogs/{blog}/publish', [BlogController::class, 'togglePublish']);

    // News Management Routes
    Route::post('/news', [NewsController::class, 'store']);
    Route::put('/news/{news}', [NewsController::class, 'update']);
    Route::delete('/news/{news}', [NewsController::class, 'destroy']);
    Route::patch('/news/{news}/publish', [NewsController::class, 'togglePublish']);

    // Consultancy Info Management Routes
    Route::post('/consultancy-info', [ConsultancyInfoController::class, 'store']);
    Route::put('/consultancy-info/{consultancyInfo}', [ConsultancyInfoController::class, 'update']);
    Route::delete('/consultancy-info/{consultancyInfo}', [ConsultancyInfoController::class, 'destroy']);

    // Consultation Management Routes
    Route::get('/consultations', [ConsultationController::class, 'index']);
    Route::get('/consultations/{consultation}', [ConsultationController::class, 'show']);
    Route::delete('/consultations/{consultation}', [ConsultationController::class, 'destroy']);

    // The 2 Special Routes
    Route::patch('/consultations/{consultation}/status', [ConsultationController::class, 'updateStatus']);
    Route::patch('/consultations/{consultation}/payment', [ConsultationController::class, 'updatePaymentStatus']);

    // Fund Application Management Routes
    Route::post('/foundation-settings', [FoundationSettingController::class, 'update']);
    Route::get('/fund-applications', [FundApplicationController::class, 'index']);
    Route::get('/fund-applications/{fundApplication}', [FundApplicationController::class, 'show']);
    Route::delete('/fund-applications/{fundApplication}', [FundApplicationController::class, 'destroy']);

    // Update Status
    Route::patch('/fund-applications/{fundApplication}/status', [FundApplicationController::class, 'updateStatus']);
    // Book Management Routes
    Route::post('/books', [BookController::class, 'store']);
    Route::post('/books/{book}', [BookController::class, 'update']); // Use POST for files
    Route::delete('/books/{book}', [BookController::class, 'destroy']);
    Route::post('/biography', [BiographyController::class, 'update']);
    Route::post('/philosophy', [PhilosophySettingController::class, 'update']);

    // Education
    Route::post('/education', [EducationController::class, 'store']);
    Route::put('/education/{education}', [EducationController::class, 'update']);
    Route::delete('/education/{education}', [EducationController::class, 'destroy']);

    // Achievements
    Route::post('/achievements', [AcademicAchievementController::class, 'store']);
    Route::put('/achievements/{academicAchievement}', [AcademicAchievementController::class, 'update']);
    Route::delete('/achievements/{academicAchievement}', [AcademicAchievementController::class, 'destroy']);
    // Experiences
    Route::post('/experiences', [ExperienceController::class, 'store']);
    Route::put('/experiences/{experience}', [ExperienceController::class, 'update']);
    Route::delete('/experiences/{experience}', [ExperienceController::class, 'destroy']);

    // Research Projects
    Route::post('/research-projects', [ResearchProjectController::class, 'store']);
    Route::match(['put', 'patch'], '/research-projects/{researchProject}', [ResearchProjectController::class, 'update']);
    Route::delete('/research-projects/{researchProject}', [ResearchProjectController::class, 'destroy']);

    // Skills
    Route::post('/skills', [SkillController::class, 'store']);
    Route::match(['put', 'patch'], '/skills/{skill}', [SkillController::class, 'update']);
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy']);
    // CV PDF
    Route::post('/cv-settings', [CvSettingController::class, 'update']);

    // Publications
    Route::post('/publications', [PublicationController::class, 'store']);
    Route::match(['put', 'patch'], '/publications/{publication}', [PublicationController::class, 'update']);
    Route::delete('/publications/{publication}', [PublicationController::class, 'destroy']);

    // Awards
    Route::post('/awards', [AwardController::class, 'store']);
    Route::match(['put', 'patch'], '/awards/{award}', [AwardController::class, 'update']);
    Route::delete('/awards/{award}', [AwardController::class, 'destroy']);
    Route::post('/hobbies', [HobbyController::class, 'store']);
    Route::post('/hobbies/{hobby}', [HobbyController::class, 'update']);
    Route::delete('/hobbies/{hobby}', [HobbyController::class, 'destroy']);
    Route::post('/social-links', [SocialLinkController::class, 'store']);
    Route::match(['put', 'patch'], '/social-links/{socialLink}', [SocialLinkController::class, 'update']);
    Route::delete('/social-links/{socialLink}', [SocialLinkController::class, 'destroy']);
    Route::post('/partners', [PartnerController::class, 'store']);
    Route::post('/partners/{partner}', [PartnerController::class, 'update']); // POST for FormData update
    Route::delete('/partners/{partner}', [PartnerController::class, 'destroy']);
    Route::post('/testimonials', [TestimonialController::class, 'store']);
    Route::post('/testimonials/{testimonial}', [TestimonialController::class, 'update']);
    Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy']);
    Route::post('/expertises', [ExpertiseController::class, 'store']);
    Route::match(['put', 'patch'], '/expertises/{expertise}', [ExpertiseController::class, 'update']);
    Route::delete('/expertises/{expertise}', [ExpertiseController::class, 'destroy']);
    Route::post('/settings', [WebsiteSettingController::class, 'update']);
    Route::apiResource('/admin/career-journeys', CareerJourneyController::class);




    });
