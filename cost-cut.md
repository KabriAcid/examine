
### ⚙️ Given Parameters

| Variable                           | Description                                                    | Value                                                                      |
| ---------------------------------- | -------------------------------------------------------------- | -------------------------------------------------------------------------- |
| **S**                              | Number of schools                                              | 2                                                                          |
| **N**                              | Students per school                                            | 100                                                                        |
| **F**                              | Exam frequency per month (per student)                         | 30                                                                         |
| **Model**                          | GPT-4.1 (text generation endpoint)                             | $5.00 per 1M input tokens, $15.00 per 1M output tokens *(as of late-2025)* |
| **Avg questions per prompt**       | 10                                                             |                                                                            |
| **Avg input tokens per prompt**    | ~200–400                                                       |                                                                            |
| **Avg output tokens per response** | ~1,000–1,500 (depending on verbosity and options/explanations) |                                                                            |

---

### 🧮 Step 1 — Token Estimate per Prompt

| Type                  | Estimated Tokens | Reasoning                                                        |
| --------------------- | ---------------- | ---------------------------------------------------------------- |
| **Prompt (input)**    | 300 tokens       | Includes subject, topic, difficulty, and instruction.            |
| **Response (output)** | 1,200 tokens     | 10 questions × ~120 tokens (question + 4 options + explanation). |
| **Total per prompt**  | 1,500 tokens     | Combined request and response total.                             |

---

### 🧮 Step 2 — Cost per Prompt

[
\text{Cost per prompt} = (300 × 5 + 1200 × 15) / 1,000,000
]

= ( (1500 + 18000) / 1,000,000 = 0.0195 ≈ $0.02 ) per prompt.

---

### 🧮 Step 3 — Monthly Usage

[
\text{Total prompts} = S × N × F = 2 × 100 × 30 = 6000 \text{ prompts/month.}
]

---

### 🧮 Step 4 — Monthly Cost

[
6000 × 0.02 = $120 \text{ per month.}
]

So, your estimated **API cost ≈ $120/month** for 2 schools with 100 students each taking 30 AI-generated tests monthly.

---

### ⚖️ Step 5 — Optimization Notes

| Strategy                                      | Description                                                      | Estimated Savings   |
| --------------------------------------------- | ---------------------------------------------------------------- | ------------------- |
| **Cache question sets**                       | Save generated sets in DB and reuse for similar subjects/topics. | Up to 70% reduction |
| **Batch generation**                          | Generate 50–100 questions per prompt instead of 10.              | 40–50% cheaper      |
| **Use smaller models (e.g., GPT-4o-mini)**    | Cheaper per token and nearly identical accuracy for MCQs.        | 80–90% cheaper      |
| **Local AI fallback (e.g., Ollama or GPT-J)** | For large-scale offline generation.                              | Only hosting cost   |

---

### ✅ Summary

| Metric                     |        Value |
| -------------------------- | -----------: |
| Cost per prompt            |  ≈ **$0.02** |
| Total prompts/month        |    **6,000** |
| **Estimated monthly cost** |   **≈ $120** |
| With caching & batching    | **≈ $30–40** |
| With GPT-4o-mini           | **≈ $10–15** |