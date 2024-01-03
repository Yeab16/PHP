<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>

                <th>Role</th>


            </tr>
        </thead>
        <tbody>

            <?php

            $query = "SELECT * FROM users";
            $select_user = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_user)) {

                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];



                echo "<tr>";
                echo "<td> $user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$user_firstname </td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";

                echo "<td>$user_role</td>";
                echo "<td><a href='user.php?admin={$user_id}'>Admin</a></td>";
                echo "<td><a href='user.php?subscriber={$user_id}'>Subscriber</a></td>";
                echo "<td><a href='user.php?src=edit_user&u_id={$user_id}'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure to delete');\" href='user.php?delete={$user_id}'>Delete</a></td>";
                echo "</tr>";

            }


            ?>








        </tbody>






    </table>
</div>