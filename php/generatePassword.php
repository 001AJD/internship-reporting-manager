<?php
function makeSeed()
{
	list($usec, $sec) = explode(' ', microtime());
	return $sec+$usec * 1000000;
}

function generatePassword()
{
	$symbol = array();
	$symbol["upperCase"] = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$symbol["lowerCase"] = "abcdefghijklmnopqrstuvwxyz";
	$symbol["digit"] = "0123456789";
	$symbol["specialChar"] = "!@#$%_";

	srand(makeSeed());
	$random_upperCase1 = rand(0,25);

	srand(makeSeed());
	$random_upperCase2 = rand(0,25);

	srand(makeSeed());
	$random_lowerCase1 = rand(0,25);

	srand(makeSeed());
	$random_lowerCase2 = rand(0,25);

	srand(makeSeed());
	$random_digit1 = rand(0,9);

	srand(makeSeed());
	$random_digit2 = rand(0,9);
	

	srand(makeSeed());
	$random_specialChar1 = rand(0,5);

	srand(makeSeed());
	$random_specialChar2 = rand(0,5);

	$password = $symbol["specialChar"][$random_specialChar1].$symbol["lowerCase"][$random_lowerCase1].$symbol["digit"][$random_digit].$symbol["lowerCase"][$random_lowerCase2].$symbol["upperCase"][$random_upperCase1]. $symbol["specialChar"][$random_specialChar2].$symbol["upperCase"][$random_upperCase2].$symbol["digit"][$random_digit2];

	return $password;


}
generatePassword();
?>