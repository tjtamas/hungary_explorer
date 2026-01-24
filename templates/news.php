<!-- News Section -->
<section id="hirek" class="news-section">
    <header class="section-header">
        <h2 class="section-title">Híreink</h2>
        <div class="section-underline"></div>
    </header>

    <div class="news-grid">
        <?php 
        $newsItems = $this->get('newsItems', []);
        
        if (empty($newsItems)): 
        ?>
            <p class="no-news">Jelenleg nincsenek hírek.</p>
        <?php else: ?>
            <?php foreach ($newsItems as $index => $news): ?>
                <article class="news-card fade-in" style="animation-delay: <?php echo $index * 0.1; ?>s;">
                    <!-- News Image -->
                    <a href="<?php echo $this->e($news['link'] ?? '#'); ?>" class="news-image-link">
                        <div class="news-image-container">
                            <img 
                                src="<?php echo $this->e($news['image'] ?? img('placeholder.jpg')); ?>" 
                                alt="<?php echo $this->e($news['title'] ?? 'Hír'); ?>"
                                class="news-image"
                                loading="lazy"
                            >
                            <?php if (!empty($news['tag'])): ?>
                                <span class="news-tag"><?php echo $this->e($news['tag']); ?></span>
                            <?php endif; ?>
                        </div>
                    </a>

                    <!-- News Content -->
                    <div class="news-content">
                        <h3 class="news-title">
                            <a href="<?php echo $this->e($news['link'] ?? '#'); ?>">
                                <?php echo $this->e($news['title'] ?? 'Cím nélkül'); ?>
                            </a>
                        </h3>

                        <?php if (!empty($news['excerpt'])): ?>
                            <p class="news-excerpt">
                                <?php echo $this->e($news['excerpt']); ?>
                            </p>
                        <?php endif; ?>

                        <div class="news-footer">
                            <?php if (!empty($news['date'])): ?>
                                <span class="news-date">
                                    <i class="far fa-calendar-alt"></i>
                                    <?php echo $this->e($news['date']); ?>
                                </span>
                            <?php endif; ?>
                            
                            <a href="<?php echo $this->e($news['link'] ?? '#'); ?>" class="news-link">
                                Tovább
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>