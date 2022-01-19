<?php
include_once 'header.php';
require_once 'includes\config.inc.php';
require_once 'includes\functions.inc.php';
privilegeLevel("Engineering");
include_once 'header.php';

if (isset($_POST["search_part_number"])) {
    $searchData = getInstruction($conn, $_POST["search_part_number"], ["search_instruction_type"]);
}
?> 

<div class="container d-flex justify-content-center align-items-center test">

    <div class="form-container ">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h3 class="login-text">Search for instruction</h3>

            <?php
            $message = getMessage();
            echo $message
            ?>

            <div class="form-group my-1 ">
                <input type="text" name="search_part_number"  class="form-control" id="search_part_number" aria-describedby="emailHelp" placeholder="Search Part Number">
            </div>

            <div class="form-group my-1 ">
                <input type="text" name="$search_instruction_type"  class="form-control" id="search_instruction_type" aria-describedby="emailHelp" placeholder="Search Instruction Type">
            </div>

                <div class="form-group ">
                    <button type="submit" name="submit" class="btn-login" name="search_instruction_submit" id='search_instruction_submit'>Search</button>
                </div>

                <div class="form-group my-1">
                    <input type="text" name="id" class="form-control" id="id" value='<?php echo htmlspecialchars($searchData['id'])?>' placeholder="Id">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="part_number" class="form-control" id="part_number" value='<?php echo htmlspecialchars($searchData['part_number'])?>' placeholder="Part Number">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="description" class="form-control" id="description" value='<?php echo htmlspecialchars($searchData['description'])?>' placeholder="Part Description">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="customer_code" class="form-control" id="customer_code" value='<?php echo htmlspecialchars($searchData['customer_code'])?>' placeholder="Customer Code">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="customer_name" class="form-control" id="customer_name" value='<?php echo htmlspecialchars($searchData['customer_name'])?>' placeholder="Customer Name">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="system_type" class="form-control" id="system_type" value='<?php echo htmlspecialchars($searchData['system_type'])?>' placeholder="System Type">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="instruction_level" class="form-control" id="instruction_level" value='<?php echo htmlspecialchars($searchData['instruction_level'])?>' placeholder="Instruction Level">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="instruction_type" class="form-control" id="instruction_type" value='<?php echo htmlspecialchars($searchData['instruction_type'])?>' placeholder="Instruction Type">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="status" class="form-control" id="status"  value='<?php echo htmlspecialchars($searchData['status'])?>' placeholder="Status">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="revision" class="form-control" id="revision" value='<?php echo htmlspecialchars($searchData['revision'])?>' placeholder="Revision">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="initial_release" class="form-control" id="initial_release" value='<?php echo htmlspecialchars($searchData['initial_release'])?>' placeholder="Initial Release">
                </div>
                <div class="form-group my-1">
                    <input type="text" name="last_update" class="form-control" id="last_update" placeholder="Last Update" value='<?php echo htmlspecialchars($searchData['last_update'])?>'>
                </div>

            </form>
        </div>
    </div>

<?php
include_once 'footer.php'
?>
