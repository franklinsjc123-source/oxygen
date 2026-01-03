 <style>
            #sidebar {
                width: 200px;
                height: 100vh;
                color: #fff;
                transition: transform 0.3s, width 0.3s; 
                overflow: hidden;
                position: fixed;
                
            }
    
            .page-body {
                /* transition: transform 0.3s, width 0.3s; */
                /* transition: margin-left 0.3s;  */
                /* margin-left: 200px; Initial margin when the sidebar is visible */
                /* width: calc(100% - 200px); */
            }
    
            #top-menu {
                /* margin-left: 100%; */
                /* padding: 10px; */
                /* text-align: center; */
                /* transition: transform 0.3s, margin-left 0.3s, width 0.3s; */
                
                /* transition: margin-left 0.3s, width 0.3s; */
                 /* Add margin-left transition */
            }
    
            .sidebar-hidden #sidebar {
                margin-right: 10;
                 transform: translateX(-200px);
                
                width: -100%;
            }
    
            .sidebar-hidden .page-body {
                margin-right: 0;
                /* transform: translateX(-200px); */
                width: 100%;
            }
    
            .sidebar-hidden #top-menu {
                margin-right: -200;
                 transform: translateX(-200px); 
                 width: calc(100% + 200px);
            }
        </style>