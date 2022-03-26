# This file exists for the sole purpose of generating a JSON file full of length 2 arrays containing [name, gender].
# These arrays should themselves all existing within one big array so that they can be selected using a random integer index

import re  # We'll be using regular expressions for this
import json  # Obviously we want to write som JSON here

BOY = 'm'
GIRL = 'f'
current_gender = BOY

def gender_swap():
    global current_gender
    global BOY
    global GIRL
    if current_gender == BOY:
        current_gender = GIRL
    elif current_gender == GIRL:
        current_gender = BOY
    else:
        raise Exception("There are more than two genders, but there shouldn't be in this program, so something has gone wrong", current_gender)

output = []

raw_file = open("raw_name_data.html", "r")

for line in raw_file:
    tag_contents = re.split('<[t|d|r|/]* align=\"[\d|\w]*\"*>|<[t|d|r|/]*>', line)
    for text in tag_contents:
        text = str(text)
        if len(text) > 0 and re.search('[a-z|A-Z]+', text):
            output.append([text,current_gender])
            gender_swap()

raw_file.close()

output_file = open("humanChildren.json", "w")
output_file.write(json.dumps(output))
output_file.close