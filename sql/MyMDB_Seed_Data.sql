use mymdb;

-- insert USER data
INSERT INTO `user` (`UserName`, `Password`, `Email`) VALUES 
('trevor','$2y$10$pFM1/JeTfd9kUJogOCTB8uDHs/.Ib8VY0SGW5FX4m2LBrTY3OANBS','trevorfawcett@gmail.com'),        -- password: 1234
('Martinez','$2y$10$pFM1/JeTfd9kUJogOCTB8uDHs/.Ib8VY0SGW5FX4m2LBrTY3OANBS','MaryGMartinez@jourrapide.com'), -- password: 1234
('Davis','$2y$10$cyeSTYVzek6M4ccqRW2.6eLFoHR7C5JXwpPUNSduDuzdmpauGfVGK','TracyJDavis@armyspy.com'),         -- password: 1234         
('Stark','$2y$10$tP33Mpd.2VIEWqc56dx0auhypk3LNEU/2sgVDHOg0GiaAn4Y0xQl2','StephenMStark@jourrapide.com'),    -- password: 1234
('Akers','$2y$10$QqO2gf/oUXSA5ilxGFfJx.NqWbz7D9/oDTCz5Fgq4svzC87eG2apW','AnnNAkers@jourrapide.com'),        -- password: 1234
('noah', '$2y$10$WRYSL1mr/VH6DoYyxlczVO0ftgHg9zTJwkk.ZSPrEyShfIGpWIsUq', 'noah@gmail.com'),                 -- password: noah123
('mia', '$2y$10$UzD5xgexNwSmdgPOE7gTv.pVsBLFKdWWtc8a4XsamRl48MahnhXWm', 'mia@yahoo.com.vn'),                -- password: mia123
('sophia', '$2y$10$jFkXGYSEY0M8kBIRVhkZpufL2lyj25xOPDqOMjmhypsXnzVb.whOC', 'sophia@gmail.com'),             -- password: sophia123
('charlie', '$2y$10$0hi2uH17qEWQ3nB/E.MC8e8iMTvh2JGr735mjl9llXtosPr5PkNW2', 'charlie@yahoo.com');           -- password: charlie123


-- insert MOVIE data
INSERT INTO `movie` (`Title`, `Poster`, `PlotSummary`, `Runtime`, `Genres`, `Crew`, `Directors`, `Awards`, `CreatedBy`) VALUES 
('Iron Man','https://m.media-amazon.com/images/M/MV5BMTczNTI2ODUwOF5BMl5BanBnXkFtZTcwMTU0NTIzMw@@._V1_SY1000_CR0,0,674,1000_AL_.jpg','Movie about Iron Man',126,'Action,Adventure','Robert Downey Jr','Jon Favreau','Best Achievement in Sound Editing, Best Achievement in Visual Effects',1),
('John Wick','https://m.media-amazon.com/images/M/MV5BMTU2NjA1ODgzMF5BMl5BanBnXkFtZTgwMTM2MTI4MjE@._V1_SY1000_CR0,0,666,1000_AL_.jpg','An ex-hit-man comes out of retirement to track down the gangsters that killed his dog and took everything from him.',126,'Action,Crime','Keanu Reeves','Chad Stahelski, David Leitch','Best Action Movie',1),
('Iron Man 2','https://m.media-amazon.com/images/M/MV5BMTM0MDgwNjMyMl5BMl5BanBnXkFtZTcwNTg3NzAzMw@@._V1_.jpg','With the world now aware of his identity as Iron Man, Tony Stark must contend with both his declining health and a vengeful mad man with ties to his father\'s legacy.',124,'Action, Adventure, Sci-Fi','Robert Downey Jr, Gwyneth Paltrow, Don Cheadle','Jon Favreau','Best Supporting Actress, Best Science Fiction Film',1),
('Black Panther','https://m.media-amazon.com/images/M/MV5BMTg1MTY2MjYzNV5BMl5BanBnXkFtZTgwMTc4NTMwNDI@._V1_SY1000_CR0,0,674,1000_AL_.jpg','T\'Challa, heir to the hidden but advanced kingdom of Wakanda, must step forward to lead his people into a new future and must confront a challenger from his country\'s past.',134,'Action, Adventure, Sci-Fi','Chadwick Boseman, Michael B. Jordan, Forest Whitaker','Ryan Coogler','Best Achievement in Music Written for Motion Pictures, Best Achievement in Production Design, Best Achievement in Special Visual Effects',4),
('The Avengers','https://m.media-amazon.com/images/M/MV5BNDYxNjQyMjAtNTdiOS00NGYwLWFmNTAtNThmYjU5ZGI2YTI1XkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_SY1000_CR0,0,675,1000_AL_.jpg','Earth\'s mightiest heroes must come together and learn to fight as a team if they are going to stop the mischievous Loki and his alien army from enslaving humanity.',143,'Action, Adventure, Sci-Fi','Robert Downey Jr, Chris Evans, Chris Hemsworth, Scarlett Johansson','Joss Whedon','Best Science Fiction Film, Best Supporting Actor, Best Special Effects, Best Writing',4),
('Avengers: Infinity War','https://m.media-amazon.com/images/M/MV5BMjMxNjY2MDU1OV5BMl5BanBnXkFtZTgwNzY1MTUwNTM@._V1_SY1000_CR0,0,674,1000_AL_.jpg','The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.',149,'Action, Adventure, Sci-Fi','Robert Downey Jr, Chris Evans, Chris Hemsworth, Scarlett Johansson','Anthony Russo, Joe Russo','Visual Effects of the Year, Outstanding Visual Effects - Feature Film, Best Vocal/Motion Capture Performance',4),
('Ant-Man','https://m.media-amazon.com/images/M/MV5BMjM2NTQ5Mzc2M15BMl5BanBnXkFtZTgwNTcxMDI2NTE@._V1_.jpg','Armed with a super-suit with the astonishing ability to shrink in scale but increase in strength, cat burglar Scott Lang must embrace his inner hero and help his mentor, Dr. Hank Pym, plan and pull off a heist that will save the world.',117,'Action, Adventure, Comedy, Sci-Fi','Paul Rudd, Evangeline Lilly, Michael Douglas, Anthony Mackie','Peyton Reed','Best Comic-to-Film Motion Picture, Biggest Surprise of the Year, Favorite Movie Poster of the Year',4),
('Doctor Strange','https://m.media-amazon.com/images/M/MV5BNjgwNzAzNjk1Nl5BMl5BanBnXkFtZTgwMzQ2NjI1OTE@._V1_SY1000_CR0,0,674,1000_AL_.jpg','While on a journey of physical and spiritual healing, a brilliant neurosurgeon is drawn into the world of the mystic arts.',115,'Action, Adventure, Fantasy, Sci-Fi','Benedict Cumberbatch, Rachel McAdams, Chiwetel Ejiofor, Benedict Wong','Scott Derrickson','Best Comic-to-Film Motion Picture,  Saturn Award	Best Director, Best Actor, Best Music',4),
('Missing Link', 'http://t2.gstatic.com/images?q=tbn:ANd9GcS4d-RMF3-pRnlI9ytfFKYzCSK3ruY5Gm7FSRcDhvg7L1aRZIO3', 'Tired of living a solitary life in the Pacific Northwest, Mr Link, who is 8 feet tall and covered in fur, recruits fearless explorer Sir Lionel Frost to guide him on a journey to find his long-lost relatives in the fabled valley of Shangri-La. Along with adventurer Adelina Fortnight, the trio encounters their fair share of peril as they travel to the far reaches of the world. Through it all, they learn that sometimes one can find a family in the places one least expects.', 95, 'Fantasy/Adventure', 'Hugh Jackman, Zach Galifianakis, Zoe Saldana', 'Chris Butler', '', 1),
('Ralph Breaks the Internet', 'http://t3.gstatic.com/images?q=tbn:ANd9GcReG7ZT8aY7MpaE0GBs-YHUtaCDgQuDa3r0IUa1e8235FylcDKd', 'Video game bad guy Ralph and fellow misfit Vanellope von Schweetz must risk it all by traveling to the World Wide Web in search of a replacement part to save Vanellope\'s video game, \"Sugar Rush.\" In way over their heads, Ralph and Vanellope rely on the citizens of the internet -- the netizens -- to help navigate their way, including an entrepreneur named Yesss, who is the head algorithm and the heart and soul of trend-making site BuzzzTube.', 116, 'Fantasy/Adventure', 'Sarah Silverman, John C. Reilly, Gal Gadot', 'Rich Moore, Phil Johnston', '', 2),
('Bumblebee', 'http://t0.gstatic.com/images?q=tbn:ANd9GcQkbMgkzbvbsHiumW4eT1jWVrS0VMVpC7bP-epscUgSEf7FQ5TM', 'On the run in the year of 1987, Bumblebee finds refuge in a junkyard in a small Californian beach town. Charlie, on the cusp of turning 18 and trying to find her place in the world, discovers Bumblebee, battle-scarred and broken.', 114, 'Science Fiction/Action', 'Hailee Steinfeld, Dylan O\'Brien, John Cena', 'Travis Knight', '', 2),
('Suicide Squad', 'https://upload.wikimedia.org/wikipedia/en/1/1a/Suicide_Squad_The_Album.png', 'Figuring they\'re all expendable, a U.S. intelligence officer decides to assemble a team of dangerous, incarcerated supervillains for a top-secret mission. Now armed with government weapons, Deadshot (Will Smith), Harley Quinn (Margot Robbie), Captain Boomerang, Killer Croc and other despicable inmates must learn to work together. Dubbed Task Force X, the criminals unite to battle a mysterious and powerful entity, while the diabolical Joker (Jared Leto) launches an evil agenda of his own.', 137, 'Fantasy/Science Fiction', 'Margot Robbie, Will Smith, Jared Leto', 'David Ayer', '', 2),
('The Lion King', 'http://t0.gstatic.com/images?q=tbn:ANd9GcSy2iMzH39dcj9KZeoulk18_LyeeoNIm5a26-2F80NY7rlVofiz', 'This Disney animated feature follows the adventures of the young lion Simba (Jonathan Taylor Thomas), the heir of his father, Mufasa (James Earl Jones). Simba\'s wicked uncle, Scar (Jeremy Irons), plots to usurp Mufasa\'s throne by luring father and son into a stampede of wildebeests. But Simba escapes, and only Mufasa is killed. Simba returns as an adult (Matthew Broderick) to take back his homeland from Scar with the help of his friends Timon (Nathan Lane) and Pumbaa (Ernie Sabella).', 90, 'Drama/Music', 'James Earl Jones, Nathan Lane, Jeremy Irons', 'Rob Minkoff, Roger Allers', '', 3),
('The Little Mermaid', 'http://t1.gstatic.com/images?q=tbn:ANd9GcRUmX0QL-sT2V7U21NGM3AhKEiX_b4Qwg4vAsCV2ZacBNU8VcXw', 'In Disney\'s beguiling animated romp, rebellious 16-year-old mermaid Ariel (Jodi Benson) is fascinated with life on land. On one of her visits to the surface, which are forbidden by her controlling father, King Triton, she falls for a human prince. Determined to be with her new love, Ariel makes a dangerous deal with the sea witch Ursula (Pat Carroll) to become human for three days. But when plans go awry for the star-crossed lovers, the king must make the ultimate sacrifice for his daughter.', 85, 'Fantasy/Melodrama', 'Jodi Benson, Samuel E. Wright', 'Ron Clements, John Musker', '', 3),
('Frozen', 'http://t3.gstatic.com/images?q=tbn:ANd9GcQoiXHk-EN-jPxlg6FnUNleLPkXPYqt4DUfQZTsAfTLb2bXIZ7a', 'When their kingdom becomes trapped in perpetual winter, fearless Anna (Kristen Bell) joins forces with mountaineer Kristoff (Jonathan Groff) and his reindeer sidekick to find Anna\'s sister, Snow Queen Elsa (Idina Menzel), and break her icy spell. Although their epic journey leads them to encounters with mystical trolls, a comedic snowman (Josh Gad), harsh conditions, and magic at every turn, Anna and Kristoff bravely push onward in a race to save their kingdom from winter\'s cold grip.', 115, 'Fantasy/Comedy music', 'Jennifer Lee, Kristen Bell', 'Jennifer Lee, Chris Buck', '', 4),
('The Huntsman: Winter\'s War', 'https://upload.wikimedia.org/wikipedia/en/a/ab/The_Huntsman_%E2%80%93_Winter%27s_War_poster.jpg', 'Betrayed by her evil sister Ravenna (Charlize Theron), heartbroken Freya (Emily Blunt) retreats to a northern kingdom to raise an army of huntsmen as her protectors. Gifted with the ability to freeze her enemies in ice, Freya teaches her young soldiers to never fall in love. When Eric (Chris Hemsworth) and fellow warrior Sara defy this rule, the angry queen does whatever she can to stop them. As war between the siblings escalates, Eric and Sara try to end Ravenna\'s wicked reign.', 120, 'Drama/Fantasy', 'Liam Neeson', 'Cedric Nicolas-Troyan', '', 4),
('Thor', 'http://www.movienewsletters.net/photos/113522R1.jpg', 'As the son of Odin (Anthony Hopkins), king of the Norse gods, Thor (Chris Hemsworth) will soon inherit the throne of Asgard from his aging father. However, on the day that he is to be crowned, Thor reacts with brutality when the gods\' enemies, the Frost Giants, enter the palace in violation of their treaty. As punishment, Odin banishes Thor to Earth. While Loki (Tom Hiddleston), Thor\'s brother, plots mischief in Asgard, Thor, now stripped of his powers, faces his greatest threat.', 130, 'Fantasy/Science Fiction', 'Chris Hemsworth, James Earl Jones', 'Kenneth Branagh', '', 1),
('Pandas', 'http://www.movienewsletters.net/photos/264975R1.jpg', 'An American biologist embarks on a life-changing journey to China to help scientists breed giant pandas and introduce the cubs into the wild.', 40, 'Short/Documentary', 'Drew Fellman, Donald Kushner, Steve Ransohoff', 'Drew Fellman, David Douglas', 'Oscar', 1);


-- insert REVIEW data
INSERT INTO `review` (`UserID`, `MovieID`, `Rating`, `Review`)  VALUES 
(5,3,4,'For some reason this movie had not been getting the greatest critic reviews. I do not understand that at all. I thought the movie was very enjoyable and a successful sequel in the series.\r\n\r\nFor anyone who has seen the first Iron Man you can expect much of the same in this movie. Robert Downey Jr. plays Tony Stark like he is meant for the part. He has the same sarcastic wit and self-confidence that is evident in his other movie roles. Gwyeneth Paltrow, as Pepper Potts, has a comes more to the forefront in the sequel. I also personally love that Jon Favreau is the driver for Stark/Potts, and that he gets into the action a little bit. You have to respect the director for that, even though Jon has done plenty of acting himself.'),
(1,3,3,'At its high points - the first act and the climax - Iron Man 2 is actually better than the first film. Everything up to and including the action scene in Monaco is just great fun to watch: the action, the character interactions, and of course Robert Downey Jr\'s wonderful portrayal of Tony Stark. And the action scene at the end is pretty epic.\r\n\r\nThe problem is, the film just stops being so much fun in-between. In a large proportion of this time, it\'s either going too slowly with little happening that\'s exciting or even particularly interesting, or it\'s providing some silly moments like Iron Man lounging on a giant display donut. To be fair, there\'s no problem with the many subplots this movie has: they all blend together quite smoothly.'),
(3,3,4,'I\'ll put it very simply, I think this movie was really cool. Excellent story, visual effects, action, all of it combined masterfully to create a great film that delivers entertainment and style throughout, without sacrificing a good plot. It has all the right elements and the cool elements in a proper balance making it fun yet not dumb.\r\n\r\nI liked a lot Iron Man 1 and I think if you also did so, then you would most likely like this one too. I really like films of this genre like Batman Begins, The Dark Knight, Hellboy 2, Watchmen and I think both Iron Man films are up to the level. It\'s great to see that this sequel is as good or even better than the first one.\r\n\r\nI absolutely recommend this movie, it kicks major ass.'),(2,8,4,'I was lucky enough to be among the press-junket last Wednesday to witness this movie! I usually rate movies by different aspects, but i\'ll also answer some questions my friends had about this film which I also had myself!\r\n\r\nActing (10/10): This cast is amazing! They embody their characters instead of trying to act like the character. Benedict as Dr. Strange was a portrayal right out of the comics! Tilda as the ancient one killed it!\r\n\r\nAction (10/10): Wow! I could argue the action in this movie being on par with the scenes in civil war. It was so incredible watching this scenes with million pieces moving yet focus sing on the main characters. Wide angles, long shots and great choreography. what else do you want?\r\n\r\nStory(8/10) : This movie had a solid story and you believed what, how and why things were going on! Villain was good and actually a memorable one for once(stab, you\'re welcome dc fans). It was not flawless though. The pace kind of slows down before the final act which was unnecessary!\r\n\r\nCinematography/VFX 10/10: The images in this film blew my mind! There is a scene in the beginning where the ancient one shows Dr strange \"the magic\" and it is great! Some serious mind-bending stuff combined with great visuals to let it manifest itself to the audience. Most artistic movie yet of marvel.\r\n\r\nOverall, i\'d give this movie an 8.5. Though this isn\'t THE best marvel movie, it is truly one of best out there. After the disappointing Jason borne, jack reach er etc. we finally have a movie that lives up to the hype! GO Watch this movie in Max 3d if possible, because it is worth it for once!\r\n\r\nSome questions that my friends asked:\r\n\r\n\"Is this better than civil war?\" - Well visual-wise on par, but story-wise civil war is better for many reasons including the fact that civil war had a lot of background information to work with. This was more of a standardized origin film. \r\n\r\n\"Is there a post-credit scene?\" - Ah yes sir! Apparently there are two, but we got to see only 1. \r\n\r\n\"Is this the most mind-boggling thing you\'ve ever seen on screen?\" - Ehm yes and no. Yes, because the effects were amazing and things I\'ve never seen before. No, nothing was so mind-blowing that it made me think different of the world or something.\r\n'),(2,7,3,'This movie is incredible. A ton of fun with brilliant action and hilarious dialogue this is another fantastic win for Marvel. Paul Rudd plays a likable and charismatic hero who really makes you root for him and his goals. Michael Pena is the real heist of this film as he steals every scene that he is in. Corey Stoll as the villain was a fantastic choice from Marvel. He can play the corporate business man and an intimidating villain. The visuals are stunning in this film. All of the tiny ant scenes are visually outstanding and hilarious. The are two post credit scenes which are fantastic and really tie into the larger universe. Ant Man is a fantastic movie which is worth your money and I suggest that you see it in cinemas.'),
(2,6,5,'I was amazed to see so many negative reviews; so many people are impossible to please. This movie was 2 1/2 hours long, but I could have sat there another 2 1/2 hours and not noticed. Thoroughly entertaining, and I love how the directors weren\'t afraid to take chances. I\'ve read a lot of other user reviews that claim that there\'s no plot. Unless you\'re mentally handicapped or not paying attention because you\'re on your phone the entire movie, the plot is pretty clear, and decent in my opinion.'),(2,1,4,'As an avid reader of the Iron Man comics, I was excited but also very scared that this movie would flop.\r\n\r\nWhile Robert Downey is not the biggest name in Hollywood, he plays the part perfectly and I was greatly impressed by how he portrayed Iron Man so well.\r\n\r\nThe humor works well for this film also. It\'s well-written and has a great cast.\r\n\r\nWhat impressed me the most was the CGI! They\'re breath-taking, but aren\'t distracting enough to let you miss the finer points of this movie.\r\n\r\nIn conclusion, while not perfect, Iron Man lives up to its hype and my expectations as a reader of the comic.'),
(2,2,4,'John Wick has a very simple, maybe even laughable plot. It is a typical guy takes his revenge movie. It can be easily summarized as \"Keanu gets pissed and shoots people in the face for 101 minutes\" but the thing is you actually can see it is really Keanu who is doing it. Instead of shaky cameras and dozens of superfast cuts, you can see kick-ass long takes which are amazingly choreographed. Since this is their first film, the director duo has a few problems with storytelling but I am glad that they made me realize how much I miss watching an action movie and actually see what\'s going on.'),(2,3,4,'For some reason this movie had not been getting the greatest critic reviews. I do not understand that at all. I thought the movie was very enjoyable and a successful sequel in the series.\r\n\r\nFor anyone who has seen the first Iron Man you can expect much of the same in this movie. Robert Downey Jr. plays Tony Stark like he is meant for the part. He has the same sarcastic wit and self-confidence that is evident in his other movie roles. Gwyeneth Paltrow, as Pepper Potts, has a comes more to the forefront in the sequel. I also personally love that Jon Favreau is the driver for Stark/Potts, and that he gets into the action a little bit. You have to respect the director for that, even though Jon has done plenty of acting himself.\r\n\r\nNormally in when they replace someone in a sequel with a different actor/actress I am very upset. However, Don Cheadle replacing Terrence Howard in Iron Man 2 as War Machine/Lt. Rhodes made me happy. This is similar to what happened with Maggie Gylenhal in the Dark Night.\r\n\r\nSamuel L. Jackson playing Nick Fury has a bigger role, and it leads all the viewers into wanting The Avengers movie to come out immediately. Scarlett Johansson also showed up with some impressive stunt work, along with her always gorgeous looks.\r\n\r\nAll in all it was a well done sequel. The plot is not too convoluted to follow. The new villain, played by Mickey Rourke, is very impressive and fun to watch. The action scenes are all entertaining but they do not completely drive the movie. The only thing that I wished for leaving the theater was a longer final fight scene.\r\n\r\nAlso, make sure to watch after the credits!! It is short, but worth it.\r\n'),(2,4,2,'Sadly I had big expectations for Black Panther as a HUGE fan of Black Lightning TV show, I was looking forward to this release only to be dismayed.\r\n\r\nAt best it is a movie made with 90% green screen sequences but in reality it is a discombobulated mash of garbage that takes way too long to develop any story whatsoever and that storyline is as thin and weak as a nightclub whiskey, left stale overnight and re-poured.\r\n\r\nThe hype is over-rated and the movie is ultimately disappointing. May appeal to Millenials who exist without a functioning braincell.'),(3,5,4,'\'Avengers Assemble\' (\'The Avengers\') is a truly enjoyable superhero film that lives up to its hype and creates a story that allows for four of the greatest superheroes to connect in this mega-blockbuster extravaganza. Joss Whedon has created one of the most action-packed Marvel films to have graced the screen, full of humour, thrills and a great cast of characters, all of which impel this visual effects-driven spectacle. Whilst I had the great opportunity to watch this epic in the cinema in 3D, the film is equally as stunning on an average television set, with the final battle between the Avengers and Loki\'s army being one of the most spectacular scenes in a superhero movie. An impressive and remarkable fantastical superhero flick from Whedon.'),
(6, 9, 5, 'As beautiful in animation style as its predecessors [but] saddled with an overwhelmingly monotonous story and lifeless humor, with little entertainment for either generation.'),
(7, 9, 4, ' A sweet, distinctively animated bit of all-ages entertainment.'),
(7, 10, 3, '*Review originally published on 30th Nov 2018* I am an avid Disney fan and for the first time in the history of Disney, I felt they portrayed something far more connected with the real life as opposed to the dream like sequence that they are always and best known to depict. It\'s a new gen story about what friendships mean in today\'s world, given the fact that the world has become much smaller and vastly connected by technology and social media. I loved the fact that sometimes letting go is hard and it can manifest itself in the form of insecurity. The solution? Create a purpose for yourself, have the courage to bid a heartfelt goodbye and make a new circle of near and dear ones. This movie made me feel much more mature and it felt as if I have watched Disney grow from an innocuous child in the 90s to a grown-up in 2018. I already feel that I have grown along with it. This movie is a gem and I really liked it. Please go to your nearby theaters to watch it! P.S. I bet you\'ll love the part wherein the princesses decide to give their wardrobes a makeover and slip into something far more practical. :)'),
(7, 11, 2, 'Travis Scott or who ever made one of the best movies I have seen. Michael bay was in it for the money but this one this one is better it focus on the story, now I heard they are making or going to make a best wars well that would be dumb and the animated of cybertron will be really stupid I think that travis were he did a short look of cybertron I think he did amazing that\'s what it needs to look like and it made me feel like I was playing war for cybertron it was very well planned and thought of, I love it so I hope this gets out to everyone about this movie bumblebee and I hope they see this because this might actually get everyone (credits and people as in fans they lost to come back) to come back instead of having a transformer series scattered like how bay did. Maybe travis needs to press the button as in the reset button for this series of movies. I believe he is the answer to all there problems and to get people to come back. I love his movie I never left a comment on none of bays but I just found him out and boy he did great. And all the people that thinks tr hey have it all right maybe ya\'ll need to watch it over and over and over and also have a son that watches it 24/7 he knows there names by heart so I say that this has been by far the biggest greatest transformer movie ever I just hope and pray that they press the reboot button and make it how it needs to be with travis he knows what\'s right and the g1 version at the beginning that\'s what they need to work on it was OUTSTANDING SO NO ANIME VERSIONS OR BEAST WARS I love what travis did and this is absolutely my first time I ever commented on this stuff I never liked Bay\'s version'),
(7, 12, 3, 'I think itâ€™s safe to say I really enjoyed watching this movie. Jared Leto plays an amazing joker and even cut his hair and shaved his eyebrows for the role. I really like Harley Quinn as well. She seemed to be the comedic relief (at least to me). The rest of the characters, besides Deadshot, Joker, and Harley Quinn were kinda unimportant. I did like how they showed the â€œvillainsâ€ (if you dare to even call some of them that ) backstorys. It also went deeper into Harley Quinn and Jokerâ€™s relationship. Very interesting. Overall I liked this movie and think you should give it a shot. It also had a really good soundtrack including Heathens by Twenty Ã˜ne PilÃ¸ts.'),
(8, 13, 2, 'This movie is the best Disney movie there is in my book. The story is so heartfelt and emotional, im sure lots of adults even cried their first time watching as well. (SPOILER ALERT IF YOU HAVENT SEEN THE MOVIE CLICK AWAY) The plot does a great job with keeping its watchers on their toes. For example, we all knew Scar, the jealous brother, was not very fond of Mufasa, but im sure no one was expecting for him killing him own brother. WOW!  Then, he even convinces Simba that it was his fault. The most emotional scene in my opinion would have to be when Scar kills his brother, and you see simba desperately trying to wake his father even though, deep down, he knows things are never gonna be the same in his world.'),
(8, 14, 1, 'This movie has a warm spot in my heart forever. My niece was just 2-1/2 when it was released and she adored it.  There was a little fellow at preschool who was her best friend, Erik. She also loved to swim. So, with the same \"boyfriend,\" and loving to swim, she totally identified with Ariel. Unfortunately, she also noticed a marked resemblance between Ursula the Sea Witch and her grandmother!  Whenever I see this movie or hear it mentioned, I can\'t help but remember with a chuckle and a jolt of affection, those years of memorizing the script while the kids watched  the video \"just one more time.\"'),
(9, 15, 5, 'Frozen is the best movie I ve ever seen. Elsa stays in fear in her childhood  days.  But her secret was revealed  and showed  evil in her after reaching  the  mountains.  Her Castle was extremely  gorgeous  made of ice. She played  the role of both heroine  and villain.  Her fight with Hans showed girl power. The last seen act of true love that elsa shared with Anna was a really  Memorable  seen.  And everybody  lived happily ever.  She was really  very brave and she chose the right way at last'),
(9, 16, 5, 'It\'s a beautiful sequel to the first movie, which I really enjoyed. It reveals a past about the huntsman we hadn\'t known before...and also advances the story as well as the past. It\'s a shame that Kristen Stewart didn\'t reappear in the movie as Snow White. I really hope they create another sequel, despite it\'s lowered box office total. I say it\'s a good movie overall and worth watching.'),
(6, 17, 5, 'Great introduction storyline for the mightiest avenger. great character development, funny at times, and solid action sequences throughout. 8/10. Only complaint is that (Spoiler) Thor does not possess his powers for much of the movie, so don\'t expect the action levels of the Avengers of other marvel movies.'),
(6, 18, 5, 'Pandas are beloved around the world, and now they are coming to the big screen in the IMAX (R) original film \"Pandas\"'),
(9, 17, 1, 'I personally think this movie too overrated and that\'s saying something since the movie only got 77% on Rotten Tomatoes. This is just boring and slow. The visual effects are fantastic and movie Asgard is stunning but we barely get to see Asgard because half the movie is in ugly new mexico. The final fight although fun is extremely forgettable. But the only 3 things that got me through the whole thing are Chris Hemsworth who was born to play Thor , Tom Hiddleston is a great Loki and Loki is a great character and the first 15 minutes are amazing. But I still think its bad and the worst marvel movie. Thor, you get a 5.5/10.'),
(9, 13, 5, 'Awesome reviews, which are posted to this movie; made me watch the movie.I would like to say that the story was well put up on work and quiet an effort was also put on designing the characters. I would like to thank the creators of this film! If you are a fan of 2D old-kinda movies then you are up for it. This was the starting movie which made possible the 2019 film \"Lion King\"                               !!AMAZING MOVIE FOR KIDS!!'),
(9, 14, 4, 'Finally a femal heroine that kniws what she whants and not afraid to fight for what she believe in but most of all the animation and music are spectacular'),
(7, 15, 5, 'Frozen is the best movie I ve ever seen. Elsa stays in fear in her childhood  days.  But her secret was revealed  and showed  evil in her after reaching  the  mountains.  Her Castle was extremely  gorgeous  made of ice. She played  the role of both heroine  and villain.  Her fight with Hans showed girl power. The last seen act of true love that elsa shared with Anna was a really  Memorable  seen.  And everybody  lived happily ever.  She was really  very brave and she chose the right way at last'),
(7, 14, 5, 'i loved this since i was a child i love it now too <3 its the best version of mermaid tails eve'),
(7, 17, 4, 'The best superhero tales are those which bring out the hero part of the character rather than the super part and Thor is one of them. The film tells a character change in a poetic manner along with a great OST by Patrick Doyle and good acting performances delivered by the entire cast.');
