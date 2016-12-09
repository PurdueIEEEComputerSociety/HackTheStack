pw_list = open("hashed").read().split("\n")
for x in range(0, len(pw_list)-2, 2):
    print len(pw_list[x])
    print pw_list[x+1]
