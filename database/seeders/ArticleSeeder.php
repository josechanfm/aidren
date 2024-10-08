<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News; // Import the News model
use Illuminate\Support\Facades\Http; // Use the Http facade for checking URL availability

class NewsSeeder extends Seeder
{
    public function run()
    {
        // Sample news data with updated image URLs
        $articles = [
            [
                'category'=>'news',
                'title' => 'New Dispute Resolution Expert Network Launched',
                'content' => 'A new network of dispute resolution experts has been established to provide better support and guidance in conflict management.',
                'author' => 'John Doe',
                'image_url' => 'https://picsum.photos/200/300?random=1', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Training Program for Mediators Announced',
                'content' => 'A comprehensive training program for mediators is set to begin next month, aiming to enhance skills and knowledge in the field.',
                'author' => 'Jane Smith',
                'image_url' => 'https://picsum.photos/200/300?random=2', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'How to Resolve Conflicts Effectively',
                'content' => 'Experts share their insights on effective strategies for conflict resolution in various settings.',
                'author' => 'Emily Johnson',
                'image_url' => 'https://picsum.photos/200/300?random=3', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Webinar on Negotiation Techniques Scheduled',
                'content' => 'Join us for an upcoming webinar focused on advanced negotiation techniques with leading experts in the field.',
                'author' => 'Michael Brown',
                'image_url' => 'https://picsum.photos/200/300?random=4', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Annual Conference on Dispute Resolution Announced',
                'content' => 'The annual conference will feature keynote speakers and workshops aimed at improving dispute resolution practices.',
                'author' => 'Sarah Davis',
                'image_url' => 'https://picsum.photos/200/300?random=5', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Case Study: Successful Mediation in Business Disputes',
                'content' => 'A recent case study highlights the effectiveness of mediation in resolving disputes between businesses.',
                'author' => 'Chris Wilson',
                'image_url' => 'https://picsum.photos/200/300?random=6', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'The Role of Technology in Modern Dispute Resolution',
                'content' => 'Exploring how technology is reshaping the landscape of dispute resolution and conflict management.',
                'author' => 'Jessica Taylor',
                'image_url' => 'https://picsum.photos/200/300?random=7', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'New Research on Family Mediation Released',
                'content' => 'Recent research findings shed light on the effectiveness of family mediation in resolving conflicts.',
                'author' => 'David Lee',
                'image_url' => 'https://picsum.photos/200/300?random=8', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Expert Panel Discusses Future of Dispute Resolution',
                'content' => 'A panel of experts gathered to discuss trends and predictions for the future of dispute resolution.',
                'author' => 'Laura Martinez',
                'image_url' => 'https://picsum.photos/200/300?random=9', // Random image
            ],
            [
                'category'=>'news',
                'title' => 'Success Stories from the Dispute Resolution Community',
                'content' => 'Read about inspiring success stories from professionals in the dispute resolution field.',
                'author' => 'Robert Anderson',
                'image_url' => 'https://picsum.photos/200/300?random=10', // Random image
            ],
        ];

        // Insert news data into the database using the News model
        foreach ($articles as $article) {
            // Create the news article
            $newsItem = News::create([
                'category'=>$article['category'],
                'title' => $article['title'],
                'content' => $article['content'],
                'author' => $article['author'],
                'published_at' => now(),
            ]);

            // Retry logic for attaching media
            $maxRetries = 3;
            $attempts = 0;
            while ($attempts < $maxRetries) {
                $response = Http::get($article['image_url']);
                if ($response->successful()) {
                    // Attach the media from the URL directly to the news article
                    $newsItem->addMediaFromUrl($article['image_url'])
                        ->toMediaCollection('thumbnail');
                    break; // Exit the loop if successful
                }
                $attempts++;
                sleep(1); // Wait for 1 second before retrying
            }

            if ($attempts == $maxRetries) {
                // Log an error or handle the failure case
                \Log::error("Failed to attach media for article: " . $article['title']);
            }
        }

    }
}