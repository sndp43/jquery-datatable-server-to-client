# jquery-datatable-server-to-client
Jquery Datatable Serverside for first page and switch to client side for other pages

In this Project I am going to use the Jquery Serverside and Client side implementation together.
Yes the Idea behind using both together is we need to only use serverside for the very first page and have the ajax calls in the async fasion in the background
to fetch the rest of the data once all the data is fetched we are going the switch to client side implementation of the datatable.

Advantages:
1. First page will load Instantly as we have implemented Server side datatable.
2. All the data will be fechted in the async fasion so there will be no page load time.
3. All the actions like sorting/filtering/pagination now we do not have to reach the server again and again as we are switching to client side datatable

Disadvantages:
1. To see realtime data we have to reload the page again.
2. till the time all the data is being loaded User will not be able to do the sorting/filtering/pagination actions.

