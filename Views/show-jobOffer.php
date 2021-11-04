<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <form action="<?php echo FRONT_ROOT ?>JobOffer/Apply" method="POST" >
            <div class="container">
                <h3 class="mb-3">Job offer</h3>
                <h4 style="color: rgb(145, 39, 177)"></h4>
                <input type="number" name="jobOfferId" class="form-control form-control-ml" hidden value="<?php echo $jobOffer->getIdJobOffer(); ?>">
                <div>
                    <div class="row">
                        <div class="col-lg-4">
                            <label for="">Company</label>
                            <input readonly name="name" class="form-control form-control-ml" value=" <?php echo $jobOffer->getCompany()->getName(); ?>">
                        </div>

                        <div class="col-lg-4">
                            <label for="">Job position</label>
                            <input readonly name="jobPositionDescription" class="form-control form-control-ml" value=" <?php echo $jobOffer->getJobPosition()->getDescription(); ?>">
                        </div>

                        <div class="col-lg-4">
                            <label for="">Description</label>
                            <textarea readonly type="text" name="jobOfferDescription"  class="form-control form-control-ml" value=""><?php echo $jobOffer->getDescription(); ?></textarea>
                        </div>

                        <div class="col-lg-4">
                            <label for="">Limit date</label>
                            <input readonly type="date" name="limitDate" class="form-control form-control-ml" value="<?php echo $jobOffer->getLimitDate(); ?>">
                        </div>

                        <div class="col-lg-4">
                            <label for="">Status</label>
                            <input readonly name="state" class="form-control form-control-ml" value="
                                <?php if ($jobOffer->getUserState() == 1) {
                                    echo "Active";
                                } else {
                                    echo "Inactive";
                                }
                                ?>">
                        </div>

                        <div class="col-lg-4">
                            <label for="">Student</label>
                            <input readonly type="text" name="student" class="form-control form-control-ml" value="
                            <?php
                            if ($jobOffer->getUser() == "") {
                                //echo $student->getFirstName() . " " . $student->getLastName();
                            } else {
                                echo "Offer available";
                            }; ?>">
                        </div>
                        <br>
                        <div id="outer" class="col-lg-12"><br>
                            

                            <button type="submit"  class="btn btn-dark float-right" ><a href="<?php echo FRONT_ROOT ?>JobOffer/jobOfferList/" style="color: white;">JobOffer List</a></button>
                            <br><br>
                            <button type="submit" name="Apply" class="btn btn-dark float-right">Apply</button>
                        </div>

                    </div>

                </div>

            </div>

        </form>
    </section>
</main>