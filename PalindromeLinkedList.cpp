Class Solution{
    public:
          bool isPalindrom(ListNode* head) {
              stack<int> s;
              ListNode*temp = head;
              while(temp!=NULL)
              {
                  s.push(temp->val);
                  temp=temp->next;
              }
              temp=head;
              int n=0;
              while(temp!=NULL)
              {
                  n=s.top();
                  s.pop();
                  if(n!=temp->val)
                  {
                      return false;
                  }
                  temp=temp->next;
               }
              return true;
          }
};
