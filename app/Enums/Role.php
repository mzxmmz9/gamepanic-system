<?php

namespace App\Enums;

enum Role: string
{
	case Developer = 'developer';
	case Admin = 'admin';
	case User = 'user';
}