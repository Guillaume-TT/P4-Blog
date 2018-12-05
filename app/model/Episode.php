<?php

namespace App\app\model;


class Episode
{
	private $id;
	private $title;
	private $content;
	private $book_id;
	private $publication_date;

	// GETTER
	public function getId() { return $this->id; }
	public function getTitle() { return $this->title; }
	public function getContent() { return $this->content; }
	public function getBook() { return $this->book_id; }
	public function getDate() { return $this->publication_date; }
	// SETTER
	public function setId($id) { $this->id = $id; }
	public function setTitle($title) { $this->title = $title; }
	public function setContent($content) { $this->content = $content; }
	public function setBook($book_id) { $this->book_id = $book_id; }
	public function setDate($publication_date) { $this->publication_date = $publication_date; }
}