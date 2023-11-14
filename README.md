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





For preferencesScores at recommendationSystem
    you can find it at
        core>app>Http>Helpers>helpers.php
            function getRecommendations
                function calculateTransientHouseScores

--------------------------------------------------------------------------------
The numbers assigned to each preference in the $preferenceScores array are arbitrary and would be determined based on the relative importance or desirability of each feature or preference. The choice of these numbers depends on your specific use case, user feedback, or any data-driven analysis you might conduct.

In a real-world scenario, you may want to gather data or insights from users to understand how much they value each feature. Alternatively, you could use historical data or conduct surveys to assign weights to preferences more accurately. The numbers provided in the example were chosen for illustrative purposes and may not reflect the actual preferences or weights in your specific application.

Here's a general guideline for how you might assign these weights:

Higher weights: Assign higher weights (e.g., closer to 1.0) to preferences that are more critical or desired by users.
Lower weights: Assign lower weights (e.g., closer to 0.0) to preferences that are less important or have less impact on user satisfaction.
For instance, in a beachfront property recommendation system, "Beach" might be assigned a higher weight because it's a crucial feature, while "Parking" might have a lower weight if it's considered less important for the overall user experience.

In practice, the assignment of these weights would likely be an iterative process that involves refining the weights based on user feedback and the performance of the recommendation system over time.
--------------------------------------------------------------------------------
