<?php
header("Access-Control-Allow-Origin: *");  // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");  // Allow these HTTP methods
header("Access-Control-Allow-Headers: Content-Type");  // Allow specific headers (if needed)
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$country = filter_input(INPUT_GET, 'country', FILTER_SANITIZE_SPECIAL_CHARS);
$lookup = filter_input(INPUT_GET, 'lookup', FILTER_SANITIZE_SPECIAL_CHARS);
if ($lookup== "cities") {
  $stmt = $conn->query("SELECT cities.name,cities.district,cities.population FROM cities JOIN countries ON cities.country_code = countries.code WHERE countries.name LIKE '%$country%' ");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  cities();
}
else{
  $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%' ");
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
  country();
}

?>
<?php function country(){
  ?>
<table>
  <thead>
  <tr>
    <th>Name</th>
    <th>Continent</th>
    <th>Independence</th>
    <th>Head of State</th>
  </tr>
  </thead>
  <tbody>
    <?php foreach ($GLOBALS['results'] as $row): ?>
    <tr>
      <td><?= $row['name'];?></td>
      <td><?= $row['continent'];?></td>
      <td><?= $row['independence_year'];?></td>
      <td><?= $row['head_of_state'];?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php
}

function cities(){
  ?>
<table>
  <thead>
  <tr>
    <th>Name</th>
    <th>District</th>
    <th>Population</th>
  </tr>
  </thead>
  <tbody>
    <?php foreach ($GLOBALS['results'] as $row): ?>
    <tr>
      <td><?= $row['name'];?></td>
      <td><?= $row['district'];?></td>
      <td><?= $row['population'];?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php
}

