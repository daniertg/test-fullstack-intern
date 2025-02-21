def sum_of_squares(n):
    return sum(int(digit)**2 for digit in str(n))

def happy_number(n):
    seen = set()
    while n != 1 and n not in seen:
        seen.add(n)
        n = sum_of_squares(n)
    return n == 1

n = int(input("Masukkan angka: "))
result = happy_number(n)


if result:
    print(f"{n} adalah Happy Number!")
else:
    print(f"{n} bukan Happy Number.")
