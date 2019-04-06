--------------------
-------SELECTS------
--------------------

--Event information: SELECT information FROM event with id = $event_id
SELECT title, date_created, date, location, event.description, price, capacity, isPrivate, users.name AS owner_name, category.name AS category_name, city 
	FROM event,users,category 
	WHERE event.id_owner=users.id_user
	    AND event.id_category=category.id_category
        AND event.id_event = $event_id;

--Account information: SELECT information FROM user with username = $username
SELECT email, name, active, verification, website
	FROM users
	FULL JOIN business ON users.id_user=business.id_user
	WHERE username = $username;


--Posts of event: select posts from event with id = $event_id
SELECT username,date, text, file."name", id_poll
	FROM post
	LEFT JOIN file ON file.id_post=post.id_post
	LEFT JOIN poll ON poll.id_post=post.id_post
	LEFT JOIN users ON users.id_user=post.id_author
	WHERE id_event = $event_id;


--Comments of posts: select comments to post with id = $post_id
SELECT username, comment.date, comment.text
	FROM post, "comment", users
		WHERE comment.id_post = post.id_post
			AND users.id_user="comment".id_author
			AND post.id_post=$post_id;

--Replies of comment: select replies to comment with id = $comment_id
SELECT username, reply.date, reply.text
	FROM "comment" parent, "comment" reply, users
		WHERE parent.id_comment = reply.id_parent_comment
		AND parent.id_comment = $comment_id
		AND users.id_user=reply.id_author;            


--Poll Options and votes: select poll options to poll with id = $poll_id and the number of votes in each option
SELECT name, count(*) as n_votes
	FROM poll_option, vote_on_poll
	WHERE id_poll= $poll_id
		AND poll_option.id_poll_option=vote_on_poll.id_poll_option
	GROUP BY name;

--Followers: select usernames of users following user with username = $username
SELECT user1.username
	FROM follow, users user1,  users user2
	WHERE id_user1 = user1.id_user
		AND id_user2 = user2.id_user
		AND user2.username = $username;

--Following: select usernames of users followed by user with username = $username
SELECT user2.username
	FROM follow, users user1,  users user2
	WHERE id_user1 = user1.id_user
		AND id_user2 = user2.id_user
		AND user1.username = $username;    

--users's tickets: select all tickets of user with username = $username
SELECT token, title, user1.username
 FROM ticket,event, users user1, users user2
 WHERE ticket.id_event=event.id_event
	AND ticket.id_ticket_owner=user1.id_user
	AND user1.username= $username
	AND user2.id_user=event.id_owner;        


--users's invites: select invites of user with username = $username
SELECT user1.username as inviter, user3.username as organizer, event.id_event
	FROM invite,event,users user1,users user2, users user3
	WHERE invite.id_inviter=user1.id_user
      AND invite.id_invitee=user2.id_user
			AND event.id_event = invite.id_event
			AND event.id_owner = user3.id_user
			AND user2.username = $username;


--search
/*events seen by the user with username = $username*/
DROP VIEW IF EXISTS able_to_see_events;

CREATE VIEW able_to_see_events AS
SELECT e1.id_event 
	FROM event e1,users user1, category, users user2
	WHERE e1.id_owner=user1.id_user
	    AND e1.id_category=category.id_category
			AND user2.username = $username
			AND (	isprivate = false
					OR
					(user2.id_user IN (SELECT id_invitee
										FROM invite
										WHERE invite.id_event=e1.id_event
					                )
				    )
				);

/*                
SELECT id_event
FROM event
WHERE REG EX CENAS 
AND event.id_event IN (select * from able_to_see_events);
*/

--reports:

--feed: 

--------------------
-------UPDATE-------
--------------------
--edit event
--edit profile:

--------------------
-------INSERTS------
--------------------
--new user
--new event
--new post
--new comment
--new ticket
--new invite
--new follow

--------------------
-------DELETES------
--------------------