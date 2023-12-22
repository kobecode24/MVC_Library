<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: http://localhost:63342/MVC_Library/View/User/books.php");
    exit;
}
$errors = $_SESSION['errors'] ?? [];
$formData = $_SESSION['form_data'] ?? [];
session_unset();

$pageTitle = 'Sign Up';
include '../templates/header.php';
?>

<div class="flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Sign Up</h2>
        <form action="../../app/Controller/SignupController.php" method="POST">
            <!-- Full Name -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="fullname">Full Name</label>
                <input class="shadow appearance-none border <?php echo isset($errors['fullname']) ? 'border-red-500' : ''; ?> rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="fullname" name="fullname" type="text" placeholder="Full Name" value="<?php echo $formData['fullname'] ?? ''; ?>">
                <?php if (isset($errors['fullname'])): ?>
                    <span class="text-red-500 text-xs italic"><?php echo $errors['fullname']; ?></span>
                <?php endif; ?>
            </div>
            <!-- Last Name -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">Last Name</label>
                <input class="shadow appearance-none border <?php echo isset($errors['last_name']) ? 'border-red-500' : ''; ?> rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="lastname" name="last_name" type="text" placeholder="Last Name" value="<?php echo $formData['last_name'] ?? ''; ?>">
                <?php if (isset($errors['last_name'])): ?>
                    <span class="text-red-500 text-xs italic"><?php echo $errors['last_name']; ?></span>
                <?php endif; ?>
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input class="shadow appearance-none border <?php echo isset($errors['email']) ? 'border-red-500' : ''; ?> rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="text" placeholder="Email" value="<?php echo $formData['email'] ?? ''; ?>">
                <?php if (isset($errors['email'])): ?>
                    <span class="text-red-500 text-xs italic"><?php echo $errors['email']; ?></span>
                <?php endif; ?>
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                <input class="shadow appearance-none border <?php echo isset($errors['password']) ? 'border-red-500' : ''; ?> rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" name="password" type="password" placeholder="Password">
                <?php if (isset($errors['password'])): ?>
                    <span class="text-red-500 text-xs italic"><?php echo $errors['password']; ?></span>
                <?php endif; ?>
            </div>

            <!-- Phone -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">Phone</label>
                <input class="shadow appearance-none border <?php echo isset($errors['phone']) ? 'border-red-500' : ''; ?> rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone" name="phone" type="tel" placeholder="Phone Number" value="<?php echo $formData['phone'] ?? ''; ?>">
                <?php if (isset($errors['phone'])): ?>
                    <span class="text-red-500 text-xs italic"><?php echo $errors['phone']; ?></span>
                <?php endif; ?>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">Sign Up</button>
                <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="/login">Already have an account?</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
