<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include_once "./php/CreateDb.php";

final class AkuasMartTest extends TestCase {

    public function testMenuClassExists(): void {
        $this->assertTrue(class_exists('CreateDb'));
    }
}


?>