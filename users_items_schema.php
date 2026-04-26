<?php
if (!function_exists('ensure_users_items_schema')) {
    function ensure_users_items_schema($con)
    {
        static $isChecked = false;

        if ($isChecked) {
            return;
        }

        $isChecked = true;

        $hasQuantity = mysqli_query($con, "SHOW COLUMNS FROM users_items LIKE 'quantity'");
        if ($hasQuantity && mysqli_num_rows($hasQuantity) === 0) {
            mysqli_query($con, "ALTER TABLE users_items ADD COLUMN quantity INT NOT NULL DEFAULT 1") or die(mysqli_error($con));
        }

        mysqli_query(
            $con,
            "ALTER TABLE users_items MODIFY status ENUM('Added to cart','Confirmed','Ordered COD','Ordered MoMo','Cancelled') NOT NULL DEFAULT 'Added to cart'"
        ) or die(mysqli_error($con));
    }
}
?>