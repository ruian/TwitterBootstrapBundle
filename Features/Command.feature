Feature: CompilerCommand
    As a Developper
    I want to compile my bootstrap twitter from less to css
    And want to merge all bootstrap js files

    Scenario: Compile twitter bootstrap v2
        When I run "twitter-bootstrap:compile v2" command
        Then I should see
        """
        Writing bootstrapv2.css from bootstrap.less
        You can add bundles/ruiantwitterbootstrap/css/bootstrapv2.css to your layout
        Writing bootstrapv2-responsive.css from responsive.less
        You can add bundles/ruiantwitterbootstrap/css/bootstrapv2-responsive.css to your layout
        Success, bootstrapv2.css has been write in /Ruian/TwitterBootstrapBundle/Resources/public/css/bootstrapv2.css
        Adding bootstrap-alert.js
        Adding bootstrap-button.js
        Adding bootstrap-carousel.js
        Adding bootstrap-collapse.js
        Adding bootstrap-dropdown.js
        Adding bootstrap-modal.js
        Adding bootstrap-popover.js
        Adding bootstrap-scrollspy.js
        Adding bootstrap-tab.js
        Adding bootstrap-tooltip.js
        Adding bootstrap-transition.js
        Adding bootstrap-typeahead.js
        Writing bootstrapv2.js
        You can add bundles/ruiantwitterbootstrap/js/bootstrapv2.js to your layout
        Success, bootstrapv2.js has been write in  /Ruian/TwitterBootstrapBundle/Resources/public/js/bootstrapv2.js

        """
        And I should get a file "bootstrapv2.css"
        And I should get a file "bootstrapv2-responsive.css"
        And I should get a file "bootstrapv2.js"

    Scenario: Compile twitter bootstrap v1
        When I run "twitter-bootstrap:compile v1" command
        Then I should see
        """
        Writing bootstrapv1.css from bootstrap.less
        You can add bundles/ruiantwitterbootstrap/css/bootstrapv1.css to your layout
        Success, bootstrapv1.css has been write in /Ruian/TwitterBootstrapBundle/Resources/public/css/bootstrapv1.css
        Adding bootstrap-alert.js
        Adding bootstrap-button.js
        Adding bootstrap-carousel.js
        Adding bootstrap-collapse.js
        Adding bootstrap-dropdown.js
        Adding bootstrap-modal.js
        Adding bootstrap-popover.js
        Adding bootstrap-scrollspy.js
        Adding bootstrap-tab.js
        Adding bootstrap-tooltip.js
        Adding bootstrap-transition.js
        Adding bootstrap-typeahead.js
        Writing bootstrapv1.js
        You can add bundles/ruiantwitterbootstrap/js/bootstrapv1.js to your layout
        Success, bootstrapv1.js has been write in  /Ruian/TwitterBootstrapBundle/Resources/public/js/bootstrapv1.js

        """
        And I should get a file "bootstrapv1.css"
        And I should get a file "bootstrapv1.js"

    Scenario: Compile twitter bootstrap
        When I run "twitter-bootstrap:compile" command
        Then I should see
        """
        Writing bootstrapv1.css from bootstrap.less
        You can add bundles/ruiantwitterbootstrap/css/bootstrapv1.css to your layout
        Success, bootstrapv1.css has been write in /Ruian/TwitterBootstrapBundle/Resources/public/css/bootstrapv1.css
        Adding bootstrap-alert.js
        Adding bootstrap-button.js
        Adding bootstrap-carousel.js
        Adding bootstrap-collapse.js
        Adding bootstrap-dropdown.js
        Adding bootstrap-modal.js
        Adding bootstrap-popover.js
        Adding bootstrap-scrollspy.js
        Adding bootstrap-tab.js
        Adding bootstrap-tooltip.js
        Adding bootstrap-transition.js
        Adding bootstrap-typeahead.js
        Writing bootstrapv1.js
        You can add bundles/ruiantwitterbootstrap/js/bootstrapv1.js to your layout
        Success, bootstrapv1.js has been write in  /Ruian/TwitterBootstrapBundle/Resources/public/js/bootstrapv1.js

        """
        And I should get a file "bootstrapv1.css"
        And I should get a file "bootstrapv1.js"

    Scenario: Clear resources
        When I run "twitter-bootstrap:clear" command
        Then I should see
        """
        Delete bootstrapv1.css
        Delete bootstrapv2-responsive.css
        Delete bootstrapv2.css
        Delete bootstrapv1.js
        Delete bootstrapv2.js
        Success every files had been removed
        
        """
        Then I should get no file
        