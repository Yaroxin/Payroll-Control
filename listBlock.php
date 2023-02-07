<?php if($useInCalc == 1): ?>
    <li class="listBlockItem" onclick="showMoreItemInfo('<?php echo $itemID; ?>');">
<?php endif; ?>
<?php if($useInCalc == 0): ?>
    <?php if($settings[7]['value'] == 0): ?>
        <li class="listBlockItem notUseInCalc" onclick="showMoreItemInfo('<?php echo $itemID; ?>');">
    <?php else: ?>
        <li class="listBlockItem" onclick="showMoreItemInfo('<?php echo $itemID; ?>');">
    <?php endif; ?>
<?php endif; ?>

    <div class="brieflyItemInfo">
        <?php 
            ksort($workTT);
            foreach($workTT as $title => $type): 
        ?>
        <?php if($type == 'День'){
                $itemDescImg = 'img/sun.png';
            }else{
                $itemDescImg = 'img/night.png';
            }
            
            if($itemType == 0){
                $itemTypeImg = 'img/hammer.png'; 
            }else{
                $itemTypeImg = 'img/clock.png';
            }            
        ?>

        <?php if($type == 'День'): ?>
        <div class="itemType mainShift">
        <?php endif; ?>
        <?php if($type == 'Ночь'): ?>
        <div class="itemType nightShift">
        <?php endif; ?>
            <div class="workTime">
                <img src="<?php echo $itemTypeImg; ?>" alt="icon">                  
            </div>
            <div class="workType">
                <img src="<?php echo $itemDescImg; ?>" alt="icon">                  
            </div>
        </div>
        <div class="itemDate">
            <?php echo date( "d.m.Y", strtotime($workShift)) ;?>  
            <div class="itemDesc">
                <?php if($extraRate > 0): ?>
                    <div class="homeExtraRate">
                        +<?php echo $extraRate;?>%
                    </div>
                <?php else: ?>
                    <?php if($useInCalc == 0): ?>
                        <?php if($settings[7]['value'] == 0): ?>
                            <div class="homeExtraRate">не учтён</div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </div>          
            <?php endforeach; ?>
        </div>

        <div class="itemHours">
            <?php echo $dayHours;?>
            <div class="itemDesc">Часов</div>
        </div>
        <div class="itemPay">
            <?php echo $product;?>
            <div class="itemDesc">Едениц</div>            
        </div>
        <div class="itemPerHour">
            <?php echo $dayPayPerHour ;?>
            <div class="itemDesc">&#8381;/час</div>
        </div>
        <div class="itemPay">
            <?php echo $dayPaySumm ;?>
            <div class="itemDesc">Рублей</div>
        </div>        
    </div>
        <?php foreach($workTT as $title => $type): ?>
            <?php if($title == 'Гиб(Рамы)'): ?>
                <div id="moreItemInfo<?php echo $itemID; ?>" class="moreItemInfo hide">                
                    <div class="moreItems">
                        <?php echo $stCount ;?>
                        <div class="itemDesc"><?php echo mb_strtolower($items[1]['title']); ?></div>
                    </div>
                    <div class="moreItems">
                        <?php echo $pvCount;?>
                        <div class="itemDesc"><?php echo mb_strtolower($items[2]['title']); ?></div>
                    </div>
                    <div class="moreItems">
                        <?php echo $pnCount ;?>
                        <div class="itemDesc"><?php echo mb_strtolower($items[3]['title']); ?></div>
                    </div>                    
                    <div class="moreItems">
                        <?php echo $noCount ;?>
                        <div class="itemDesc"><?php echo mb_strtolower($items[4]['title']); ?></div>
                    </div>
                    <div class="moreItems">
                        <?php echo $item5Count ;?>
                        <div class="itemDesc"><?php echo mb_strtolower($items[5]['title']); ?></div>
                    </div>
                    <div class="moreItems moreItemsBonus">
                        <?php echo $bonus; ?>
                        <div class="itemDesc">премия</div>
                    </div>
                    <div class="moreItems moreItemsFine">
                        <?php echo $fine; ?>
                        <div class="itemDesc">штраф</div>
                    </div>
                </div>
            <?php endif;?>
        <?php endforeach; ?>
</li>