<?php

namespace App\Providers;

use App\Interfaces\AppSettingRepositoryInterface;
use App\Interfaces\AreaRepositoryInterface;
use App\Interfaces\AttachmentAbleRepositoryInterface;
use App\Interfaces\AttachmentRepositoryInterface;
use App\Interfaces\AttendanceRepositoryInterface;
use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\CourseUserRepositoryInterface;
use App\Interfaces\DeviceTokenRepositoryInterface;
use App\Interfaces\EmployeeRepositoryInterface;
use App\Interfaces\MethodRepositoryInterface;
use App\Interfaces\NotificationRepositoryInterface;
use App\Interfaces\PaymentsRepositoryInterface;
use App\Interfaces\PermissionRepositoryInterface;
use App\Interfaces\RoleRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\SpecializationRepositoryInterface;
use App\Interfaces\WishlistRepositoryInterface;
use App\Repositories\AppSettingRepository;
use App\Repositories\AreaRepository;
use App\Repositories\AttachmentAbleRepository;
use App\Repositories\AttachmentRepository;
use App\Repositories\AttendanceRepository;
use App\Repositories\BaseRepository;
use App\Repositories\CityRepository;
use App\Repositories\CourseRepository;
use App\Repositories\CourseUserRepository;
use App\Repositories\DeviceTokenRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\MethodRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\PaymentsRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Repositories\SpecializationRepository;
use App\Repositories\WishlistRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(AttachmentRepositoryInterface::class, AttachmentRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(SpecializationRepositoryInterface::class, SpecializationRepository::class);
        $this->app->bind(AreaRepositoryInterface::class, AreaRepository::class);
        $this->app->bind(CityRepositoryInterface::class, CityRepository::class);
        $this->app->bind(AttachmentAbleRepositoryInterface::class, AttachmentAbleRepository::class);
        $this->app->bind(AreaRepositoryInterface::class, AreaRepository::class);
        $this->app->bind(WishlistRepositoryInterface::class, WishlistRepository::class);
        $this->app->bind(MethodRepositoryInterface::class, MethodRepository::class);
        $this->app->bind(AppSettingRepositoryInterface::class, AppSettingRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(CourseUserRepositoryInterface::class, CourseUserRepository::class);
        $this->app->bind(DeviceTokenRepositoryInterface::class, DeviceTokenRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class, AttendanceRepository::class);
        $this->app->bind(PaymentsRepositoryInterface::class, PaymentsRepository::class);

    }  


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
