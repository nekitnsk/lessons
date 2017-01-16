<?php include_once 'functions/database.php'; ?>
<form method="post" action="functions/save_goods.php">
    <div class="form-row-indented">
        <?php
        if($clicked_item['private'] == 1) {
            echo '<label class="form-label-radio">' .
                '<input type="radio" checked="" value="1" name="private">Частное лицо' .
                '</label>' .
                '<label class="form-label-radio">' .
                '<input type="radio" value="0" name="private">Компания' .
                '</label>';
        } else {
            echo '<label class="form-label-radio">' .
                '<input type="radio" value="1" name="private">Частное лицо' .
                '</label>' .
                '<label class="form-label-radio">' .
                '<input type="radio"  checked="" value="0" name="private">Компания' .
                '</label>';
        }
        ?>
    </div>

    <div class="form-row">
        <label for="fld_seller_name" class="form-label">
            <b id="your-name">Ваше имя</b>
        </label>
        <input type="text" maxlength="40" class="form-input-text" value="<?php echo $clicked_item['seller_name'] ?>" name="seller_name" id="fld_seller_name">
    </div>

    <div class="form-row">
        <label for="fld_email" class="form-label">Электронная почта</label>
        <input type="text" class="form-input-text" value="<?php echo $clicked_item['email'] ?>" name="email" id="fld_email">
    </div>

    <div class="form-row">
        <label id="fld_phone_label" for="fld_phone" class="form-label">Номер телефона</label>
        <input type="text" class="form-input-text" value="<?php echo $clicked_item['phone'] ?>" name="phone" id="fld_phone">
    </div>

    <div id="f_location_id" class="form-row form-row-required">
        <label for="region" class="form-label">Город</label>
        <select title="Выберите Ваш город" name="location_id" id="region" class="form-input-select">
            <option value="">-- Выберите город --</option>
            <option class="opt-group" disabled="disabled">-- Города --</option>
            <?php
            foreach ($cities as $value => $city) {
                if ($value == $clicked_item['location_id']) {
                    echo '<option data-coords=",," selected="selected" value="'. $value .'">' . $city . '</option>';
                } else {
                    echo '<option data-coords=",," value="'. $value .'">' . $city . '</option>';
                }
            }
            ?>
        </select>

        <div id="f_metro_id">
            <select title="Выберите станцию метро" name="metro_id" id="fld_metro_id" class="form-input-select">
                <option value="">-- Выберите станцию метро --</option>
                <?php
                foreach ($railway_stations as $value => $station) {
                    if ($value == $clicked_item['metro-id']) {
                        echo '<option value="'. $value .'" selected="selected">' . $station . '</option>';
                    } else {
                        echo '<option value="'. $value .'">' . $station . '</option>';
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-row">
        <label for="fld_category_id" class="form-label">Категория</label>
        <select title="Выберите категорию объявления" name="category_id" id="fld_category_id" class="form-input-select">
            <option value="">-- Выберите категорию --</option>
            <?php
            foreach ($categories as $value => $subcategories) {
                echo '<optgroup label="'. $value .'">';
                foreach ($subcategories as $subcategory_index => $subcategory) {
                    if ($subcategory_index == $clicked_item['category_id']) {
                        echo '<option value="' . $subcategory_index . '" selected="selected">'. $subcategory . '</option>';
                    } else {
                        echo '<option value="' . $subcategory_index . '">'. $subcategory . '</option>';
                    }
                }
            }
            echo '</optgroup>';
            ?>
        </select>
    </div>

    <div id="f_title" class="form-row f_title">
        <label for="fld_title" class="form-label">Название объявления</label>
        <input type="text" maxlength="50" class="form-input-text-long" value="<?php echo $clicked_item['title']; ?>" name="title" id="fld_title">
    </div>

    <div class="form-row">
        <label for="fld_description" class="form-label" id="js-description-label">
            Описание объявления
        </label>
        <textarea maxlength="3000" name="description" id="fld_description" class="form-input-textarea"></textarea>
    </div>

    <div id="price_rw" class="form-row rl">
        <label id="price_lbl" for="fld_price" class="form-label">Цена</label>
        <input type="text" maxlength="9" class="form-input-text-short" value="<?php echo $clicked_item['price']; ?>" name="price" id="fld_price">&nbsp;
        <span id="fld_price_title">руб.</span>
        <a class="link_plain grey right_price c-2 icon-link" id="js-price-link" href="">
            <span>Правильно указывайте цену</span>
        </a>
    </div>

    <div class="form-row-indented form-row-submit b-vas-submit" id="js_additem_form_submit">
        <div class="vas-submit-button pull-left">
            <span class="vas-submit-border"></span>
            <span class="vas-submit-triangle"></span>
            <input type="submit" value="Сохранить" id="form_submit" name="save_form_submit<?php echo $key; ?>" class="vas-submit-input">
        </div>
    </div>
</form>