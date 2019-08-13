    <script src="http://krie.kkk/kree_menu/template-editor.js" ></script>
    <link href="http://krie.kkk/kree_menu/template-editor.css" rel="stylesheet" >
    <div class="kree-menu">
        <div class="left-side">
            <div class="navbar-header">
                <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> -->
                <a class="navbar-brand logo toggleMenu" data-for=".main-section"><img src="http://krie.kkk/img/white_logo.png" class="logo-img"></a>
            </div>            
            <div id="kree-nav" >
                <ul class="nav nav-stacked" id="sidebar"><!--                         <li><a href="/home" ><span class="glyphicon glyphicon-home"></span></a></li>
                    <li><a href="/learner" title="Kree Leaner"><span class="glyphicon glyphicon-import"></span></a></li> --><!-- <li><a href="#" title="Add Something" class="toggleMenu" data-for=".add-section" ><span class="glyphicon glyphicon-plus"></span></a></li>-->
                    <li ><a class="kreeOpenDrawer" data-for=".sections-section"><span class="glyphicon glyphicon-align-center"></span><span class="menu-text">Sections</span></a></li>
                    <li ><a class="kreeOpenDrawer" data-for=".pages-section"><span class="glyphicon glyphicon-file"></span><span class="menu-text">Pages</span></a></li>
                    <li ><a href="#" class="btnSaveChangesKree" title="This will make your changes live."><span class="glyphicon glyphicon-floppy-save"></span><span class="menu-text">Save</span></a></li>
                    <li ><a href="#" class="btnSaveChangesKree" title="Exit the editor."><span class="glyphicon glyphicon-log-out"></span><span class="menu-text">Exit</span></a></li>
                    <li class="bottom"><a >&copy;</a></li>
                </ul></div>
        </div>
        <div id="drawer" >
            <!-- ngSwitchWhen: database -->
            <h4 class="menu_heading"><!-- Operations --></h4>
            <div class="inner">
                <ul class="main-section"><a class="btn btn-primary btn-block btnCreateProject">Create New Project</a>
                    <a class="btn btn-primary btn-block btnTemplateBuilder">Kree Template Builder</a>                        
                </ul><ul class="add-section"><span class="kreeLoading">Loading Add Options...</span></ul><ul class="sections-section"><span class="kreeLoading">Loading Sections...</span></ul><ul class="pages-section"><span class="kreeLoading">Loading Pages...</span></ul></div>
        </div>
        <div id="sub-drawer" >
            <!-- ngSwitchWhen: database -->
            <h4 class="sub-menu_heading"><!-- Operations --></h4>
            <div class="sub-inner">
                <!-- <a class="btn btn-primary btn-block btnCreateProject">Create New Project</a>
                <a class="btn btn-primary btn-block btnTemplateBuilder">Kree Template Builder</a> -->
                <ul class="">Wa Sub</ul></div>
        </div> 
        <div class="choose_section_types">
            <input type="hidden" class="section-predecessor"><div class="kree-container-option" data-option="container">
                <img src="http://krie.kkk/img/iPad.png" class="kree_ipad_image kree_ipad_image1"><div class="overlay-container">
                    <div class="container-highlight">Container</div>
                </div>
            </div>
            <div class="kree-container-option" data-option="container-fluid">
                <img src="http://krie.kkk/img/iPad.png" class="kree_ipad_image kree_ipad_image2"><div class="overlay-container-fluid">
                    <div class="container-highlight">Container Fluid</div>
                </div>
            </div>
            <div class="msg-insert-position">
            </div>
        </div>
        <input type="hidden" class="kreeAddOption">
        <div class="debug"></div>
    </div>    
