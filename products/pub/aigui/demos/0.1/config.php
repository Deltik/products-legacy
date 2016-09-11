<?php

/***************\
| CONFIGURATION |
\***************/

$support_headers = array("Chatbot", "Input/Sending", "Receiving", "Output", "Memory (sessions)", "Get Name", "Set Name", "Get Topic", "Set Topic");

// Legend:
//  0: Yes
//  1: Yes, with remarks
//  2: Unknown
//  3: No
//  4: Can't
$support_items = array(
                       "A.L.I.C.E." => array(0, 0, 0, 0, 0, 0, 0, 0),
                       "Lauren" => array(0, 0, 0, 0, 0, 0, 0, 0),
                       "Elbot" => array(0, 0, 0, 0, 4, 0, 4, 4),
                       "Kyle" => array(0, 0, 0, 0, 0, 0, 4, 4),
                       "Splotchy" => array(0, 0, 0, 4, 4, 1, 4, 4),
                       "AI-er" => array(0, 0, 0, 4, 4, 4, 4, 4),
                      );

$descriptions = array(
                      '<a href="http://alice.pandorabots.com/" target="_blank">A.L.I.C.E.</a>' => "A.L.I.C.E. (Artificial Linguistic Internet Computer Entity) is a three-time winner of the Loebner prize for \"most human computer\" free natural language artificial intelligence chat robot. The software used to create A.L.I.C.E. is available as free (\"open source\") Alicebot and AIML software.",
                      '<a href="http://lauren.vhost.pandorabots.com/pandora/talk?botid=f6d4afd83e34564d" target="_blank">Lauren</a>' => "Lauren Bot is a variant of A.L.I.C.E., using AIML, and it won the 2002 Divabot contest.",
                      '<a href="http://www.elbot.com/" target="_blank">Elbot&trade;</a>' => "Elbot is a chatterbot created by Fred Roberts, using Artificial Solutions’ technology. It has been online since 2001.",
                      '<a href="http://www.leeds-city-guide.com/kyle" target="_blank">Kyle</a>' => "Kyle is a unique learning artificial intelligence chat robot, that aims to simulate natural human language. Although originally based upon AIML concepts, Kyle employs a unique contextual learning methodology. In some ways he models the way humans learn language, knowledge and context, relying on the principles of positive and negative feedback. This approach is very different to the majority of chatbots, which are often rule-bound and finite.",
                      '<a href="http://www.algebra.com/cgi-bin/chat.mpl" target="_blank">Splotchy</a>' => "Splotchy is a funny, cranky, but mostly good artificial intelligence robot. He responds to flirting if he is in a good mood. <span style=\"color: brown; font-weight: bold;\">Splotchy is not capable of remembering anything.</span>",
                      '<a href="http://infosbit.ismywebsite.com/AI/index.php" target="_blank">AI-er</a>' => "AI-er is an amateur computer science project. <span style=\"color: brown; font-weight: bold;\">AI-er is not capable of remembering anything.</span>",
                     );


?>
