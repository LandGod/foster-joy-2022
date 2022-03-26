try:
    import re  # Regular expression library, possibly not needed.
    import csv  # CSV Parsing Library
    import urllib.parse as parseURL # For formatting data when constructing the url. Will use urllib.parse.quote()
    import sys  # So I can grab command line arguments for the file name.
    import json  # Obviously we want to write som JSON here

    # For optional gui file explorer
    from tkinter import Tk
    from tkinter.filedialog import askopenfilename


    # Output should be in this format:
    # [
    #     [gender, age, toy],
    #     [gender, age, toy],
    # ]

    # Imports a file name from the command line if the user has supplied one.
    # If the user has not supplied one, prompt the user
    try:
        filename = sys.argv[1]
    except(IndexError):
        Tk().withdraw() # we don't want a full GUI, so keep the root window from appearing
        filename = askopenfilename() # show an "Open" dialog box and return the path to the selected file

    # Check file type
    if filename[-4:] != '.csv':
        extention_location = filename.rfind(".")
        if extention_location != -1: 
            extention = filename[extention_location:] 
        else: 
            extention = '<no extention>'
        raise TypeError('Incorrect file type! Filetype must be: .csv', extention)

    # Open csv file called test.csv and create a dictionary of data based off of the given field names
    # Note that each Field name entry will include all cells up and down from the title, inclusive of the title, until the end of the document, so 
    # we must take care to ignore data we don't need

    output = {
        "tod":[],
        "kid":[],
        "teen":[]
        }

    with open(filename, newline='') as csvfile:

        # Generate csv dictionary for each row based on supplied column headings. Returns iterable full of dictionaries. 
        reader = csv.DictReader(csvfile, fieldnames=['gender', 'age', 'toy'])


        allResults =''

        for row in reader:
            try:
                # For useable rows, put each piece of relevent info into variables
                gender = row['gender'].strip()
                age = row['age'].strip()
                toy = row['toy'].strip()
                
                if ('month' in age or int(age) < 6):
                    output["tod"].append([age, gender, toy])
                elif (int(age) < 12 ):
                    output["kid"].append([age, gender, toy])
                else:
                     output["teen"].append([age, gender, toy])
            except:
                pass

    output_file = open("profiles.json", "w")
    output_file.write(json.dumps(output))
    output_file.close()

except:
        raise