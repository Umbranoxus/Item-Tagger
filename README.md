# Item-Tagger

This has a basic admin panel in order to add tagged items (editing not available) please format the keywords like so following "item1,item2,item3"

To create an admin account run this on the "adminpanel" database "INSERT INTO `admins` (`id`, `username`, `password`, `salt`) VALUES
(1, 'Richard', 'b5c5a9102db9b877e2fce0e59d6d7db0', '204814a0-00e3-4940-a34c-fa353c6bd3a4');"

This will create an admin account with the username "Richard" and password "test"

The users frontend has a basic algorithm to find tagged items locations at whichever store they choose, with 3 levels of accuracy based on the certainty of what the algorithm finds

Level 1 "We're not sure, maybe..." gives out the first find in the query, not very accurate.

Level 2 "Most Likely..." is if the algorithm finds a keyword that contains the item queried

Level 3 "Defitely" an exact match, the algorithm will continue looping through ever result in order to hopefully find a Level 3 answer, if not go to Level 2, if Level 2 isn't found, Level 1

This algorithm is completely scalable based on how populated the database is, the algorithm doesn't need to be tweaked. If the database has loads of information the algorithm has potential to be extremely accurate

The function that determines this result can also be implemented into a batch search of multiple items, but this is an MVP, so didn't want to make it to fancy.
