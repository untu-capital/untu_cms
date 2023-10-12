<?php
?>

<!-- Form grid Start -->
<div class="pd-20 card-box mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue h4">Update Loan Application Info</h4>
            <p class="mb-30">Personal Information</p>
        </div>
<!--        <div class="pull-right">-->
<!--            <a href="#form-grid-form" class="btn btn-primary btn-sm scroll-click" rel="content-y" data-toggle="collapse" role="button"><i class="fa fa-code"></i> Source Code</a>-->
<!--        </div>-->
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <?php $user_loans = loans('/'.$_GET['loan_id']); ?>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>First Name <span class="required">*</span></label>
                    <input type="text" id="first-name" name = "firstname" required maxlength = "40" minlength="3" class="form-control"  placeholder="<?php echo $user_loans['firstName']; ?>" value="<?php echo $user_loans['firstName']; ?>" readonly>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Middle Name</label>
                    <input id="middle-name" class="form-control col" type="text" maxlength = "40" minlength="0" name="middleName" >
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Last Name <span class="required">*</span></label>
                    <input type="text" name="lastname"  maxlength = "40" minlength="2" placeholder="<?php echo $user_loans['lastName']; ?>" value="<?php echo $user_loans['lastName']; ?>" readonly required class="form-control ">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Date Of Birth *</label>
                    <input id="birthday" class="date-picker form-control" name = "dob" required="required" placeholder="DD MM YYYY" value="<?php echo $user_loans['dateOfBirth']; ?>" min="<?php $date = date("Y-m-d", strtotime("-65 years")); echo $date;?>" max="<?php $date = date("Y-m-d", strtotime("-18 years"));
                    ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>I.D Number *</label>
                    <input type="text" id="id" name="id_number" placeholder="63-1234567Q05" value="<?php echo $user_loans['idNumber']; ?>" required="required" maxlength = "17" minlength="12" class="form-control">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Gender *</label>
                    <select class="custom-select2 form-control" name="gender" style="width: 100%; height: 38px" required>
                        <option value="<?php echo $user_loans['gender']; ?>"><?php echo $user_loans['gender']; ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Marital Status *</label>
                    <select class="custom-select2 form-control" name="marital" style="width: 100%; height: 38px" required>
                        <option value="<?php echo $user_loans['maritalStatus']; ?>"><?php echo $user_loans['maritalStatus']; ?></option>
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Phone Number *</label>
                    <input type="number" id="phonenumber" name ="phonenumber" placeholder="<?php echo $user_loans['phoneNumber']; ?>" value="<?php echo $user_loans['phoneNumber']; ?>" readonly maxlength = "13" minlength="6" required class="form-control  " >
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Loan Amount *</label>
                    <input type="number" name="loan" placeholder="<?php echo $user_loans['loanAmount']; ?>" value="<?php echo $user_loans['loanAmount']; ?>" required class="form-control">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Tenure <b>(Months)</b> *</label>
                    <input type="number" name="tenure" placeholder="<?php echo $user_loans['tenure']; ?>" value="<?php echo $user_loans['tenure']; ?>" required min = "1" max = "48" class="form-control" >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 col-sm-12">
                <div class="form-group">
                    <label>Street No. *</label>
                    <input type="text" id="street_no" name="street_no" value="<?php echo $user_loans['streetNo']; ?>" maxlength = "6" minlength="1" required="required" class="form-control ">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Street Name *</label>
                    <input type="text" id="street_name" name="street_name" value="<?php echo $user_loans['streetName']; ?>" maxlength = "40" minlength="3" required="required" class="form-control " >
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Suburb *</label>
                    <input type="text" id="surbub" name="surbub" value="<?php echo $user_loans['suburb']; ?>" maxlength = "40" minlength="3" required="required" class="form-control " >
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>City *</label>
                    <select class="custom-select2 form-control" name="city"  style="width: 100%; height: 38px" required>
                        <option placeholder="Select City" value="<?php echo $user_loans['city']; ?>"><?php echo $user_loans['idNumber']; ?></option>
                        <?php $cities = cities();
                        foreach ($cities as $city) { echo "<option value='$city[name]'>$city[name]</option>";} ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Select Branch</label>
                    <select class="custom-select2 form-control" name="branchName" style="width: 100%; height: 38px" required>
                        <option value="<?php echo $user_loans['branchName']; ?>"><?php echo $user_loans['branchName']; ?> Branch</option>
                        <?php
                        $branches = branch();
                        foreach ($branches as $branch) {
                            if ($branch['branchName'] !== "Head Office") {
                                echo "<option value='{$branch['branchName']}'>{$branch['branchName']} Branch</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

            </div>
        </div>
        
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Business Section</h4>
                <p class="mb-30">Fill in details about your business</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Business Sector</label>
                    <select class="custom-select2 form-control" name="industry_code" style="width: 100%; height: 38px" required>
                        <option value="<?php echo $user_loans['industryCode']; ?>"><?php echo $user_loans['industryCode']; ?></option>
                        <option value=null>Select Option</option>
                        <?php $sector = industries();
                        foreach ($sector as $ind) { echo "<option value='$ind[name]'>$ind[name]</option>"; } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Business Start Date</label>
                    <input id="businessStartDate" name="businessStartDate" value="<?php echo $user_loans['businessStartDate']; ?>" min="1905-01-01" max="2022-12-31" class="date-picker form-control" placeholder="DD MM YYYY">
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>Business Name</label>
                    <input type="text" id="businessName" name="businessName" value="<?php echo $user_loans['businessName']; ?>" maxlength = "40" minlength="2" required="required" class="form-control "  >
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label for="pob">Business Address</label>
                    <textarea type="text" id="pob" name="pob" required="required" maxlength = "40" minlength="4" class="form-control"><?php echo $user_loans['placeOfBusiness']; ?></textarea>
                </div>
            </div>
        </div>

        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Next of Kin 1 Details *</h4>
                <p class="mb-30">Fill in next of kin information</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Full name</label>
                    <input type="text" name="next_of_kin_name" class="form-control" value="<?php echo $user_loans['nextOfKinName']; ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="next_of_kin_phone" class="form-control " value="<?php echo $user_loans['nextOfKinPhone']; ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Relationship</label>
                    <select class="custom-select2 form-control" name="next_of_kin_relationship" style="width: 100%; height: 38px" required>

                        <option value="<?php echo $user_loans['nextOfKinRelationship'];?>"><?php echo $user_loans['nextOfKinRelationship'];?></option>                        <option value=null>Select Option</option>
                        <option value="spouse">Spouse</option>
                        <option value="parent">Parent</option>
                        <option value="sibling">Sibling</option>
                        <option value="friend">Friend</option>
                        <option value="relative">Relative</option>
                        <option value="business_associate">Business Associate</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Residential Address</label>
                    <textarea type="text" name="next_of_kin_address" class="form-control"></textarea>
                </div>
            </div>
        </div>

        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Next of Kin 2 Details (Optional)</h4>
                <p class="mb-30">Fill in next of kin information</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label>Full name</label>
                    <input type="text" name="next_of_kin_name2" class="form-control" value="<?php echo $user_loans['nextOfKinName2']; ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" name="next_of_kin_phone2" class="form-control" value="<?php echo $user_loans['nextOfKinPhone2']; ?>">
                </div>
            </div>
            <div class="col-md-3 col-sm-12">
                <div class="form-group">
                    <label>Relationship</label>
                    <select class="custom-select2 form-control" name="next_of_kin_relationship2" style="width: 100%; height: 38px">
                        <option value="<?php echo $user_loans['nextOfKinRelationship2'];?>"><?php echo $user_loans['nextOfKinRelationship2'];?></option>
                        <option value=null>Select Option</option>
                        <option value="spouse">Spouse</option>
                        <option value="parent">Parent</option>
                        <option value="sibling">Sibling</option>
                        <option value="friend">Friend</option>
                        <option value="relative">Relative</option>
                        <option value="business_associate">Business Associate</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Residential Address</label>
                    <textarea type="text" name="next_of_kin_address2" class="form-control" ></textarea>
                </div>
            </div>
        </div>

<!--        <h3 class="StepTitle" style="color: black">Terms and Conditions</h3>-->
<!--        <p><input type = "checkbox" class="icheckbox_flat-green flat" required>-->
<!--            I do hereby declare that the Information given is true, correct and that should any misinterpretations be contained herein UNTU Capital shall be entitled-->
<!--            to immediate full repayment of the loan plus interest and charges without prejudice to any of its right. In the event of a loan facility being granted to me by UNTU.-->
<!--            I agree to abide their terms and conditions.-->
<!--        </p>-->
        <input class="form-control" type="hidden" name="loanId" required value="<?php echo $_GET['id'] ?>">
        <input class="btn btn-success" type = "submit" value = "Update Application Details" name= "loan_application" id = "submit" Style = "border-radius: 0.38em; border:none; align: centre;">

    </form>
</div>
<!-- Form grid End -->

