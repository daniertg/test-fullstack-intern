nums = [3,2,3]
# nums = [2,2,1,1,1,2,2]
majority = len(nums) // 2
for num in nums:
    if nums.count(num) > majority:
        print(num)
        break