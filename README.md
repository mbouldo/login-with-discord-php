#### **UPDATED** 
A simple login with Discord using PHP


### Changes:

1. **Corrected Redirect URI Parameter Name**:
   - Changed `'redirect_url'` to `'redirect_uri'` in the payload array.

2. **Added Content-Type Header in Token Request**:
   - Included `'Content-Type: application/x-www-form-urlencoded'` in the cURL options for the token request.

3. **Improved Error Handling for Token Request**:
   - Added error handling after the token request to exit the script if an `'error'` key is present in the response.

4. **Removed Redundant Code and Improved Structure**:
   - Organized the code into logical sections and removed redundant redirect code for better clarity and efficiency.

### Purpose:

These changes align the code with the expected flow and requirements of Discord's OAuth2 implementation, correcting previous issues that led to failure in obtaining the access token and user information.
