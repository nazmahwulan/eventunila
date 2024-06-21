<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Table with Tailwind CSS</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-4">
  <div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Responsive Table</h1>
    <div class="overflow-x-auto">
      <table class="min-w-full bg-white">
        <thead>
          <tr>
            <th class="px-4 py-2 border">Header 1</th>
            <th class="px-4 py-2 border">Header 2</th>
            <th class="px-4 py-2 border">Header 3</th>
            <th class="px-4 py-2 border">Header 4</th>
            <th class="px-4 py-2 border">Header 5</th>
            <!-- Tambahkan lebih banyak header jika diperlukan -->
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="px-4 py-2 border">Content 1</td>
            <td class="px-4 py-2 border">Content 2</td>
            <td class="px-4 py-2 border">Content 3</td>
            <td class="px-4 py-2 border">Content 4</td>
            <td class="px-4 py-2 border">Content 5</td>
            <!-- Tambahkan lebih banyak konten jika diperlukan -->
          </tr>
          <tr>
            <td class="px-4 py-2 border">Content 1</td>
            <td class="px-4 py-2 border">Content 2</td>
            <td class="px-4 py-2 border">Content 3</td>
            <td class="px-4 py-2 border">Content 4</td>
            <td class="px-4 py-2 border">Content 5</td>
            <!-- Tambahkan lebih banyak konten jika diperlukan -->
          </tr>
          <!-- Tambahkan lebih banyak baris jika diperlukan -->
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
