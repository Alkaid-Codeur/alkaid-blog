<?php
require 'vendor/autoload.php';
use App\PDOConnection;
use Faker\Factory;

$pdo = PDOConnection::getPDO();
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE users');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');


$faker = Factory::create('fr_FR');
$categories = [];
$posts = [];

for($i=0; $i < 15; $i++) {
	$word = str_replace(' ', '', $faker->words(2, true));
	$pdo->query("INSERT INTO category(slug, name) VALUES('{$faker->slug(2)}', '{$word}')");
	$categories[] = $pdo->lastInsertId();
}

$password = password_hash('motdepasse', PASSWORD_BCRYPT);
$pdo->query("INSERT INTO users (mail, username, password) VALUES ('admin@gmail.com', 'blog_admin', '$password') ");
$user_id= $pdo->lastInsertId();



for ($i=0; $i<50; $i++) {
	$slug = $faker->slug(3);
	$title = $faker->sentence(rand(6, 10));
	$created_at = $faker->date() .' ' .$faker->time();
	$content = $faker->paragraphs(rand(8, 15), true);
	$pdo->query("INSERT INTO post (slug, title, created_at, author_id, content) VALUES ('{$slug}', '{$title}', '{$created_at}', $user_id , '{$content}')");
	$posts[] = $pdo->lastInsertId();
}

foreach($posts as $post) {
	$randomCategories = $faker->randomElements($categories, rand(1, count($categories)));
	foreach ($randomCategories as $randomCategory) {
		$pdo->query("INSERT INTO post_category (post_id, category_id) VALUES ($post, $randomCategory)");
	};
}

// for($i = 1; $i<=50; $i++) {
// 	dump($faker->paragraph(rand(5, 10)));
// }
