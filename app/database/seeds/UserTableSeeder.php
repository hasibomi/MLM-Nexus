<?php

class UserTableSeeder extends Seeder
{
	public function run()
	{
		$u = new User;

		$u->name = "Admin";
		$u->email = "admin@nexusitzone.com";
		$u->password = Hash::make("123456");
		$u->active = 1;
		$u->gender = "Male";
		$u->type = "admin";

		$u->save();
	}
}