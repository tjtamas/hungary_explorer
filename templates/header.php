<!-- Header with Top Navigation -->
<header id="header" class="site-header">
    <div class="header-top" style="background-image: url('<?php echo img("logo/frame.png"); ?>');">
        <div class="header-container">
            <!-- Logo -->
            <a href="<?php echo url(''); ?>" class="logo-link">
          <div class="logo">
    <img src="<?php echo img('logo/logo3.png'); ?>" alt="MFS Logo" class="logo-image">

    <span class="logo-text">
        <strong class="logo-title">Magyarország Felfedezői Szövetség</strong>
        <span class="logo-subtitle">Alapítva 1989</span>
    </span>

</div>
            </a>

         <!-- Desktop Navigation -->
<nav class="main-nav desktop-nav">
    <ul class="nav-menu">
        <li><a href="<?php echo url(''); ?>">Kezdőlap</a></li>
        <li class="has-submenu">
            <a href="#">Bemutatkozás <i class="fas fa-chevron-down"></i></a>
            <ul class="submenu">
                <li><a href="<?php echo url('rolunk'); ?>">Rólunk</a></li>
                <li><a href="<?php echo url('jelvenyeink'); ?>">Jelvényeink</a></li>
                <li><a href="<?php echo url('muzeumunk'); ?>">Múzeumunk</a></li>
            </ul>
        </li>
        <li class="has-submenu mega-menu">
            <a href="#">Csapataink <i class="fas fa-chevron-down"></i></a>
            <div class="mega-dropdown">
                <div class="mega-column">
                    <h4>Erdély</h4>
                    <ul>
                        <li><a href="<?php echo url('csapataink/harmasfalu'); ?>">Hármasfalu</a></li>
                        <li><a href="<?php echo url('csapataink/kibed'); ?>">Kibéd</a></li>
                        <li><a href="<?php echo url('csapataink/sovarad'); ?>">Sóvárad</a></li>
                    </ul>
                </div>
                <div class="mega-column">
                    <h4>Felvidék</h4>
                    <ul>
                        <li><a href="<?php echo url('csapataink/felsoszeli'); ?>">Felsőszeli</a></li>
                    </ul>
                </div>
                <div class="mega-column">
                    <h4>Magyarország</h4>
                    <ul>
                        <li><a href="<?php echo url('csapataink/mad'); ?>">Mád</a></li>
                    </ul>
                </div>
            </div>
        </li>
        <li class="has-submenu">
            <a href="#">Multimédia <i class="fas fa-chevron-down"></i></a>
            <ul class="submenu">
                <li><a href="<?php echo url('galeria'); ?>">Képgaléria</a></li>
                <li><a href="<?php echo url('videok'); ?>">Videógaléria</a></li>
            </ul>
        </li>
        <li><a href="<?php echo url('kapcsolat'); ?>">Kapcsolat</a></li>
    </ul>
</nav>

            <!-- Mobile Hamburger -->
            <button id="hamburger" class="hamburger" aria-label="Menü">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

  <!-- Mobile Navigation -->
<nav class="main-nav mobile-nav" id="mobileNav">
    <ul class="mobile-menu">
        <li><a href="<?php echo url(''); ?>">Kezdőlap</a></li>
        <li>
            <span class="mobile-opener">Bemutatkozás <i class="fas fa-chevron-down"></i></span>
            <ul class="mobile-submenu">
                <li><a href="<?php echo url('rolunk'); ?>">Rólunk</a></li>
                <li><a href="<?php echo url('jelvenyeink'); ?>">Jelvényeink</a></li>
                <li><a href="<?php echo url('muzeumunk'); ?>">Múzeumunk</a></li>
            </ul>
        </li>
        <li>
            <span class="mobile-opener">Csapataink <i class="fas fa-chevron-down"></i></span>
            <ul class="mobile-submenu">
                <li class="mobile-submenu-group">
                    <strong>Erdély</strong>
                    <ul>
                        <li><a href="<?php echo url('csapataink/harmasfalu'); ?>">Hármasfalu</a></li>
                        <li><a href="<?php echo url('csapataink/kibed'); ?>">Kibéd</a></li>
                        <li><a href="<?php echo url('csapataink/sovarad'); ?>">Sóvárad</a></li>
                    </ul>
                </li>
                <li class="mobile-submenu-group">
                    <strong>Felvidék</strong>
                    <ul>
                        <li><a href="<?php echo url('csapataink/felsoszeli'); ?>">Felsőszeli</a></li>
                    </ul>
                </li>
                <li class="mobile-submenu-group">
                    <strong>Magyarország</strong>
                    <ul>
                        <li><a href="<?php echo url('csapataink/mad'); ?>">Mád</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <span class="mobile-opener">Multimédia <i class="fas fa-chevron-down"></i></span>
            <ul class="mobile-submenu">
                <li><a href="<?php echo url('galeria'); ?>">Képgaléria</a></li>
                <li><a href="<?php echo url('videok'); ?>">Videógaléria</a></li>
            </ul>
        </li>
        <li><a href="<?php echo url('kapcsolat'); ?>">Kapcsolat</a></li>
    </ul>
</nav>
</header>