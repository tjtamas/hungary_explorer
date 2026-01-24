<!-- Banner Section -->
<section id="banner" class="banner-section">
    <div class="banner-content">
        <div class="banner-text">
            <header class="banner-header">
                <h1 class="banner-title"><?php echo $this->e($this->get('bannerTitle', 'A Szövetségről')); ?></h1>
                <p class="banner-quote"><?php echo $this->e($this->get('bannerQuote', '"Őseim országot szereztek, én Szülőföldemet teszem hazámmá"')); ?></p>
            </header>
            
            <div class="banner-description">
                <p><?php echo $this->e($this->get('bannerText', 'Szövetségünk 1989. szeptemberében alakult.')); ?></p>
            </div>
            
            <ul class="banner-actions">
                <li>
                    <a href="<?php echo $this->e($this->get('bannerButtonLink', url('include/rolunk'))); ?>" class="btn btn-primary">
                        <?php echo $this->e($this->get('bannerButtonText', 'Tovább')); ?>
                    </a>
                </li>
            </ul>
        </div>

        <div class="banner-image-wrapper">
            <div class="banner-image lightbox-trigger">
                <img 
                    id="nagykep" 
                    src="<?php echo $this->e($this->get('bannerImage', img('DSC_2546.jpg'))); ?>" 
                    alt="<?php echo $this->e($this->get('bannerImageAlt', 'Magyarország Felfedezői Szövetség csoportkép')); ?>"
                    loading="lazy"
                >
            </div>
        </div>
    </div>
</section>