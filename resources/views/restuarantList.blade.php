<!doctype html>
<html>
  <body>
    <table border='1' style='border-collapse: collapse;'>
      <tr>
        <th>resname</th>
        <th>date</th>
        <th>visits</th>
        <th>rating</th>
      </tr>
      @foreach($restuarantListData as $user)
      <tr>
        <td>{{ $resname->username }}</td>
        <td>{{ $date->name }}</td>
        <td>{{ $visits->email }}</td>
        <td>{{ $rating->email }}</td>
      </tr>
      @endforeach
    </table>
  </body>
</html>