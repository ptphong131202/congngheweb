<?php

namespace App\Models;

use PDO;

class Book
{
	private PDO $db;

	public int $id = -1;
	public ?string $title;
	public ?string $description;
	public ?int $pages;
	public ?int $price;

	public function __construct(PDO $pdo)
	{
		$this->db = $pdo;
	}

	public function all(): array
	{
		$books = [];

		$query = $this->db->prepare('select * from books');
		$query->execute();
		while ($row = $query->fetch()) {
			$book = new Book($this->db);
			$book->fillFromDb($row);
			$books[] = $book;
		}

		return $books;
	}

	public function save()
	{
		$result = false;

		if ($this->id >= 0) {
			$query = $this->db
				->prepare('update books set title = :title, description = :description,
                            pages_count = :pages_count, price = :price where id = :id');
			$result = $query->execute([
				'id' => $this->id,
				'title' => $this->title,
				'description' => $this->description,
				'pages_count' => $this->pages,
				'price' => $this->price
			]);
		} else {
			$query = $this->db
				->prepare('insert into books (title, description, pages_count, price)
                            values (:title, :description, :pages_count, :price)');
			$result = $query->execute([
				'title' => $this->title,
				'description' => $this->description,
				'pages_count' => $this->pages,
				'price' => $this->price
			]);
			if ($result) {
				$this->id = $this->db->lastInsertId();
			}
		}

		return $result;
	}

	public function delete()
	{
		$query = $this->db->prepare('delete from books where id = :id');
		return $query->execute(['id' => $this->id]);
	}

	public function findById(int $id)
	{
		$query = $this->db->prepare('select * from books where id = :id');
		$query->execute(['id' => $id]);
		if ($row = $query->fetch()) {
			$this->fillFromDb($row);
			return $this;
		}
		return null;
	}

	protected function fillFromDb(array $row)
	{
		[
			'id' => $this->id,
			'title' => $this->title,
			'description' => $this->description,
			'pages_count' => $this->pages,
			'price' => $this->price
		] = $row;

		return $this;
	}

	public function fill(array $data)
	{
		$this->title = $data['title'] ?? NULL;
		$this->description = $data['description'] ?? NULL;
		$this->pages = $data['pages'] ?? NULL;
		$this->price = $data['price'] ?? NULL;
		return $this;
	}
}
