<?php


namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserRepository
{
    public function getAllForAdmin() {
        return User::all();
    }

    public function getAllForEmployee() {
        return User::select('id', 'surname', 'name', 'patronymic', 'birthday', 'role', 'photo')->get();
    }

    public function setImage($img = null) {
         if ($img != null) {
             return Storage::putFile('photos', $img);
         }
    }

    public function pay(User $user, $sum) {
        $user->update([
            'money' => $user->money + $sum
        ]);
    }

    public function create($user) {
        User::create([
            'surname' => $user->surname,
            'name' => $user->name,
            'patronymic' => $user->patronymic,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => Hash::make($user->password),
            'photo' => $user->photo,
            'birthday' => $user->birthday,
        ]);
    }

    public function update($user, $new) {

        return $user->update([
            'surname' => $new->surname,
            'name' => $new->name,
            'patronymic' => $new->patronymic,
            'phone' => $new->phone,
            'birthday' => $new->birthday,
            'role' => $new->role,
            'photo' => $new->photo,
        ]);
    }

    public function delete($user) {
        return User::destroy($user->id);
    }
}
