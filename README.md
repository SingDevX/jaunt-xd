app>Http>Controllers>PropertyController -- email here
app>Http>Controllers>SiteController -- recommendations process
    create a helper function here to create a recommendation
        get user info by $user = auth()->user()

        pass user info to the helper function 
            then helper function will use that info to find which to recommend



how find which controller is called in a route
    go to laravel debug bar > Route


Todo:
created Demographics model - done
created form for inserting demographics - done
created route to insert demographics - done

create recommendation function
if there is logged in user display recommendations in home
    if demographics exist
        display recommendation
    else 
        display prompt to go to dashboard then input demographics
else 
    dont display