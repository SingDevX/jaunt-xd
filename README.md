app>Http>Controllers>PropertyController -- email here
app>Http>Controllers>SiteController -- recommendations process
    create a helper function here to create a recommendation
        get user info by $user = auth()->user()

        pass user info to the helper function 
            then helper function will use that info to find which to recommend



how find which controller is called in a route
    go to laravel debug bar > Route
