# OnlineUserWebApplication
This application displays the IPaddress of the user as soon as they land on the webpage, and the data is auto incremented with each user that lands on the page. This also shows the geolocation and time logged on in a table format, also shows the marker location of the user on a map created using mapbox api.

All the code is in a single file index.php

To get the output, connection to ngrok must be established as without a public endpoint the IPaddress returned will be '1'.
Connect to ngrok using the following command in a shell: ./ngrok http 'YOUR BROWSER PORT NUMBER'.

To store the data, I have used mysql database. A simple table that consists of headers: IPaddress, Location, Timelogged in.

Objectives achieved:
1) Retreival of user IP and storing it.
2) Generation of location of user using the IPaddress
3) Display table showing user IP, Location and Timelogged in
4) Display map with marker pointing to users location.

Objectives not achieved:
1) Auto increment of table on all user interfaces when a new user logs on. (Ajax required)
2) Automatically displaying multiple markers of users to all the users logged on. (Ajax required)
