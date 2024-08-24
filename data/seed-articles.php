<?php

$articles = json_decode(file_get_contents('./articles.json'), true);

$dns = 'mysql:host=localhost;dbname=blog';
$user = 'mohamed';
$pwd = "1234";

try{
    $pdo = new PDO($dns, $user, $pwd,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}catch(PDOException $e){
    
    echo $e->getMessage();
}

$statement = $pdo->prepare('insert into article (title, category, content, image) values (:title, :category, :content, :image)');

foreach($articles as $article){
    $statement->bindValue(':title', $article['title']);
    $statement->bindValue(':category', $article['category']);
    $statement->bindValue(':content', $article['content']);
    $statement->bindValue(':image', $article['image']);
    $statement->execute();
}
?>