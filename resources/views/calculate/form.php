<div style="display: flex; justify-content: center; align-items: center; height: 100%;">
    <div class="card">
        <div class="card-body">
            <?php if (!empty($errors) && is_array($errors)) { ?>
                <?php foreach ($errors as $field => $error) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $field . ": " . $error ?>
                    </div>
                <?php } ?>
            <?php } ?>
            <form action="/price-calculate/calculate" method="post">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <label for="default_markup">Default Markup</label>
                        </div>
                        <div class="col">
                            <input type="text" name="default_markup" id="default_markup"
                                   class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"><label for="cost">Cost</label></div>
                        <div class="col"><input type="text" name="cost" id="cost" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"><label for="tax_rate">Tax Rate</label></div>
                        <div class="col">
                            <select name="tax_rate" id="tax_rate" class="form-select">
                                <option value="0">0</option>
                                <option value="7">7</option>
                                <option value="20">20</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"><label for="rounding_rule">Rounding Rule</label></div>
                        <div class="col">
                            <select name="rounding_rule" id="rounding_rule" class="form-select">
                                <option value="00">00</option>
                                <option value="95">95</option>
                                <option value="99">99</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-group">
                            <div class="col"><label for="pricing_mode">Pricing Mode</label></div>
                            <div class="col">
                                <select name="pricing_mode" id="pricing_mode" class="form-select">
                                    <option value="tax_inclusive_prices">Tax inclusive price</option>
                                    <option value="tax_exclusive_prices">Tax exclusive price</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" value="submit" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <?php if (isset($result)) { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col">Exclusive Tax</div>
                    <div class="col"><?= $result["exclusiveTax"]; ?></div>
                </div>
                <div class="row">
                    <div class="col">Inclusive Tax</div>
                    <div class="col"><?= $result["inclusiveTax"]; ?></div>
                </div>
                <div class="row">
                    <div class="col">Gross Profit (%)</div>
                    <div class="col"><?= $result["grossProfitPercentage"]; ?></div>
                </div>
                <div class="row">
                    <div class="col">Gross Profit ($)</div>
                    <div class="col"><?= $result["grossProfitAmount"]; ?></div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
