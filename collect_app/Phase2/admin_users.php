<!--
  File: admin_users.php
  Author: Shane John
  Date: 2025-08-02
  Course: CPSC 3750 – Web Application Development
  Purpose: Displays registered users for administrative oversight and sometimes saccount unlocking.
  Notes: Admin interface is mostly view-only except for unlocking accounts.
         The button to unlock a users account only shows when that user has locked themself out.
-->

<?php
    
    require_once __DIR__ . '/db/usersTable/usersTable_admin.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta content="width=device-width, initial-scale=1.0">
    <title>Admin Users List</title>
    <link rel="stylesheet" href="../../main_style.css">
    <link rel="stylesheet" href="css/collect.css">
    <link rel="stylesheet" href="css/collect2.css">
</head>
<body>
    <!-- Common NavBar -->
    <div class="wrapper">
        <?php include '../../navbar.php'; ?>
    </div >
    <!-- Collect NavBar -->
    <header>  
        <?php include 'collect_nav.php'; ?>
    </header>
     <!-- Main Page -->
    <main class="container">
        <h2>Current Registered Users</h2>
        <?php if (empty($users)): ?>
            <p>No users found.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th>Last Login</th>
                        <th>Total Logins</th>
                        <th>Failed Attempts</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u['name']); ?></td>
                        <td><?php echo htmlspecialchars($u['email']); ?></td>
                        <td><?php echo htmlspecialchars($u['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($u['last_login_at']); ?></td>
                        <td><?php echo htmlspecialchars($u['login_count']); ?></td>
                        <td>
                            <?php echo htmlspecialchars($u['failed_login_count']); ?>
                            <?php if ((int)$u['is_locked'] === 1): ?>
                                <span class="locked">(Locked)</span>
                                <form method="post" style="display:inline">
                                    <input type="hidden" name="unlock_id" value="<?php echo $u['id']; ?>">
                                    <button type="submit" class="btn">Unlock</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>
</body> 
</html>
