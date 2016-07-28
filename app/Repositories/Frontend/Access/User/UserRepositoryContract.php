<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/7/20
 * Time: 19:23
 */
namespace App\Repositories\Frontend\Access\User;

interface UserRepositoryContract
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $email
     * @return mixed
     */
    public function findByEmail($email);

    /**
     * @param $token
     * @return mixed
     */
    public function findByToken($token);

    /**
     * @param $data
     * @param bool $provider
     * @return mixed
     */
    public function create($data, $provider = false);

    /**
     * @param $data
     * @param $provider
     * @return mixed
     */
    public function findOrCreateSocial($data, $provider);

    /**
     * @param $token
     * @return mixed
     */
    public function confirmAccount($token);

    /**
     * @param $user
     * @return mixed
     */
    public function sendConfirmationEmail($user);

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function updateProfile($id, $input);

    /**
     * @param $input
     * @return mixed
     */
    public function changePassword($input);
}