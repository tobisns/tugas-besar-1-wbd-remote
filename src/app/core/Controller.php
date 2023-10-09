<?php
class Controller
{
    public function  parse_raw_http_request(array &$a_data = null): void
    {
      // read incoming data
      $input = file_get_contents('php://input');

        // Pisahkan data berdasarkan boundary
        $boundary = '------WebKitFormBoundarywKRjkq3zpvN2joFZ';
        $parts = explode($boundary, $input);

        // Buat variabel untuk menyimpan data yang diurai
        $parsed_data = [];

// Loop melalui setiap bagian
        foreach ($parts as $part) {
            // Hapus spasi ekstra dan karakter newline
            $part = trim($part);

            // Jika bagian tidak kosong, parse dan tambahkan ke array
            if (!empty($part)) {
                list($headers, $content) = explode("\r\n\r\n", $part, 2);
                preg_match('/name="([^"]+)"/', $headers, $matches);
                $name = $matches[1];
                $parsed_data[$name] = trim($content);
            }
        }

// Sekarang, $parsed_data berisi data yang diuraikan
        var_dump($parsed_data);
    }
    public function view($folder, $view, $data = [])
    {
        require_once __DIR__ . '/../views/' . $folder . '/' . $view . '.php';
        return new $view($data);
    }

    public function model($model)
    {
        require_once __DIR__ . '/../models/' . $model . '.php';
        return new $model();
    }

    public function middleware($middleware)
    {
        require_once __DIR__ . '/../middlewares/' . $middleware . '.php';
        return new $middleware();
    }

}