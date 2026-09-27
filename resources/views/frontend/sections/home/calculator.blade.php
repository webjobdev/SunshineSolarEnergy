<!-- Solar Calculator Section Start -->
<div class="solar-calculator">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="calculator-box wow fadeInUp">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="section-title">
                                <h3>Solar Calculator</h3>
                                <h2>Your Solar Savings Calculator</h2>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="solar-form">
                                <form id="solarForm" action="#" method="POST" data-toggle="validator">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <select name="category" class="form-control" id="category" required>
                                                <option value="">Category</option>
                                                <option value="residential">Residential</option>
                                                <option value="commercial">Commercial</option>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Full Name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <input type="text" name="bill" class="form-control" id="bill" placeholder="Your Average Monthly Bill?" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="form-group col-md-6 mb-3">
                                            <input type="text" name="capacity" class="form-control" id="capacity" placeholder="Required Solar Plant Capacity (in kW)" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" class="btn-default">Calculate</button>
                                            <div id="msgSubmit" class="h3 text-left hidden"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Solar Calculator Section End -->