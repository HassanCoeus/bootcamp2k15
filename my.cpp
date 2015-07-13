class Solution {
public:
    int findKthLargest(vector<int>& nums, int k) {
        sort(nums.begin(),nums.end());
        int count=nums.size();
        for(vector<int>::iterator i=nums.begin();i<nums.end();i++)
        {
            if(count==k)
            {
                return *i;
            }
            count--;
        }
        
    }
};
