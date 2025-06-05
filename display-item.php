<div class="item" data-category="<?php echo strtolower($row['category']); ?>">
    <div class="itemimg">
        <img src="<?php echo htmlspecialchars($row['img_path']); ?>" alt="<?php echo htmlspecialchars($row['img_name']); ?>" class="imgedit">
        <button type="submit" class="description" name="submit">
            <svg class="descriptionicon" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021
                      M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
            </svg>
        </button>
    </div>
    <div class="name">
        <?php echo htmlspecialchars($row['img_name']); ?><br>
        £<?php echo number_format($row['price'], 2); ?> | <?php echo htmlspecialchars($row['calories']); ?> cal
    </div>
    <button type="submit" class="addToCart" name="submit">
        <svg class="addtocartbtn" xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
    </button>
</div>
