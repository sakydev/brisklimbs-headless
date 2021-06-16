## BriskLimbs Headless [A work in progress]
A headless video sharing soultion to adapt to any of your needs

**Note**: This is very initial draft of what this project is going to be. This is far from being useful. But you're welcome to explore :)

### API Endpoints

##### `/videos`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /videos | List videos  | `scope` [public, private, unlisted</br>`status` pending, ok, processing, failed</br>`state` active, inactive, frozen</br>`limit` results to fetch</br>`start` offset to add</br>`sort_by` fild to sort by</br>`order_by` DESC, ASC
| **GET** | /videos/{video}  | Single video details  | `video`    
| **GET** | /videos/{video}/{field}  | Single video details with custom fields  | fields separated by commas    
| **GET** | /videos/search/{keyword}  | Search videos  | `keyword` + all `/videos` params;    
| **PUT** | /videos/{video}/edit  | Edit single video  | fields to update with their values 
| **POST** | /videos/upload  | Upload video  | `file`, `title`, `description`    
| **DELETE** | /videos/{video}  | Delete a video  | `video`    

##### `/videos/comments`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /videos/{video}/comments  | Get video comments  | `limit`
| **GET** | /videos/{video}/comments/{comment}  | Single comment details  | `comment` 
| **PUT** | /videos/{video}/comments/{comment}/edit  | Edit a comment  | `content`   
| **POST** | /videos/{video}/comments  | Add video comment  | `content`
| **POST** | /videos/{video}/comments/{comment}/reply  | Reply video comment  | `content`   
| **DELETE** | /videos/{video}/comments/{comment}  | Delete video comment  | `comment`     

##### `/users`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /users | List users  | `limit`; `sort` id or total_uploads; `sort_order` desc, asc    
| **GET** | /users/{user}  | Single user details  | `user`    
| **GET** | /users/{user}/{field}  | Single user details with custom fields  | `keyword` + all /users params;    
| **GET** | /users/search/{keyword}  | Search users  | `keyword` + all `/users` params;    
| **PUT** | /users/{user}/edit  | Edit single user  | fields to update with their values    
| **DELETE** | /users/{user}  | Delete a user  | `user`    
| **POST** | /users/register  | Create user  | `username`, `email`, `password`    
| **POST** | /users/login  | Login user  | `username` or `email` + `password`  

##### `/users/subscribers`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /users/{user}/subscribers  | Get user subs  | `limit`
| **POST** | /users/{user}/subscribers  | Add user sub  | `username`    
| **DELETE** | /users/{user}/subscribers  | Delete user sub  | `username`    

##### `/users/{user}/history`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /users/{user}/history  | Get user watch history  | `limit`</br>`start`
| **POST** | /users/{user}/history  | Add a video to watch history  | `video` 
| **DELETE** | /users/{user}/history  | Delete entire watch history  |  
| **DELETE** | /users/{user}/history/{video}  | Delete a single item from watch history  |    

##### `/users/{user}/playlists`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /users/{user}/playlists  | Get user playlists  | `limit`   
| **GET** | /users/{user}/playlists/{playlist}  | Get single playlist details  | 
| **PUT** | /users/{user}/playlists/{playlist}/edit  | Edit playlist details  | `title` 
| **POST** | /users/{user}/playlists  | Create new playlist  | `title`  
| **PUT** | /users/{user}/playlists/{playlist}  | Add video to playlist  | `video`   
| **DELETE** | /users/{user}/playlists/{playlist}/{video}  | Delete video from playlist  |   


##### `/users/{user}/favorites`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /users/{user}/favorites  | Get user favorites  | `limit` 
| **POST** | /users/{user}/favorites  | Add a video to favorites  | `video` 
| **DELETE** | /users/{user}/favorites  | Delete entire favorites  | `limit` 
| **DELETE** | /users/{user}/favorites/{video}  | Delete a single item from favorites  | `limit`   

##### `/admin/settings`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /admin/settings  | Get overall settings  | `limit` 
| **POST** | /admin/settings  | Add a new setting  | `name`, `value` 
| **PUT** | /admin/settings  | Update settings in bulk  | a list of `name`, `value`
| **PUT** | /admin/settings/{setting}  | Update single setting  | `name`, `value` 
| **DELETE** | /admin/settings/{setting}  | Delete a setting  |  

##### `/admin/categories`
| Method | Endpoint  | Description | Params
| ------------- | ------------- | ------------- | ------------- |
| **GET** | /admin/categories  | Get all categories  | `limit`
| **GET** | /admin/categories/{category}  | Get single category details  | 
| **PUT** | /admin/categories/{category}  | Update a category  | `name`, `description`
| **DELETE** | /admin/categories/{category}  | Delete a category  | 
| **POST** | /admin/categories  | Add new category  | `name`, `description`   
