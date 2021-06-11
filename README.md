## BriskLimbs Headless
A headless video sharing soultion to adapt to any of your needs

**Note**: This is very initial draft of what this project is going to be. This is far from being useful. But you're welcome to explore :)

### API Endpoints

| Method | Endpoint  | Description | Params	| Example	|
| ------------- | ------------- | ------------- | ------------- | ------------- |
| **GET** | /videos | List videos  | `limit`; `sort` id or views; `sort_order` desc, asc  | {host}/videos  |
| **GET** | /videos/search  | Search videos  | `keyword`; all /videos params;  | {host}/videos/search  |

GET: /videos
	GET: /videos/search/{keyword}
	GET: /videos/{video}
		GET: /videos/{video}/edit
		GET: /videos/{video}/{field}
	POST: /videos
		POST: /videos/{video}
		PUT: /videos/{video}
		DELETE: /videos/{video}
